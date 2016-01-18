<?php

namespace BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BookingBundle\Entity\Scheduler as Scheduler;
use AppBundle\Controller\Main;

class SchedulerController extends Main {

    var $repository = 'BookingBundle:Scheduler';
    var $newentity = '';

    /**
     * @Route("/scheduler/events")
     * 
     */
    public function eventsAction() {
        $out = '[
        { "id": "1", "resourceId": "a","allDay":true,"start": "2016-01-06", "end": "2016-01-18", "title": "event 1","editable":true},
        { "id": "2", "resourceId": "b","allDay":true, "start": "2016-01-06", "end": "2016-01-13", "title": "event 2","editable":true },
	{ "id": "3", "resourceId": "d","allDay":true, "start": "2016-01-06", "end": "2016-01-08", "title": "event 3","editable":true }
        ]';



        $request = Request::createFromGlobals();

        //echo $request->query->get("start");

        $startTime = strtotime($request->query->get("start"));
        $endTime = strtotime($request->query->get("end"));
        
        
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('BookingBundle:RoomCategory')->findAll();

        foreach (@(array) $results as $roomCategory) {
            for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {
                $thisDate = date('Y-m-d', $i);
                $rooms = $roomCategory->getRoomIds();
                $books = array();
                if (count($rooms)) {
                    $query = $em->createQuery('SELECT p.id FROM BookingBundle:Scheduler p WHERE p.room in (' . implode(',', $rooms) . ') AND p.start <= :date AND p.end > :date')
                            ->setParameter('date', $thisDate);
                    $books = $query->getResult();
                }

                $json = array();
                $d = count($rooms) - count($books);

                $json["id"] = "A" . $roomCategory->getId() . $i;
                $json["resourceId"] = "RC-" . $roomCategory->getId();
                $json["start"] = $thisDate;
                $json["end"] = $thisDate;
                $json["title"] = "A:" . $d;
                $json["overlap"] = true;
                $json["editatable"] = 0;
                $json["backgroundColor"] = '#ff8000';

                $jsonarr[] = $json;

                $json = array();
                $json["id"] = "B" . $roomCategory->getId() . $i;
                $json["resourceId"] = "RC-" . $roomCategory->getId();
                $json["start"] = $thisDate;
                $json["end"] = $thisDate;
                $json["title"] = "B:" . count($books);
                $json["overlap"] = true;
                $json["editatable"] = 0;
                $json["dragable"] = false;
                $json["backgroundColor"] = '#af8000';
                $jsonarr[] = $json;
            }
        }

        $results = $em->getRepository('BookingBundle:Scheduler')->findAll();
        foreach (@(array) $results as $scheduler) {
            $json = array();
            $json["id"] = $scheduler->getId();
            $json["resourceId"] = $scheduler->getRoom()->getRoomCategory()->getId() . "-" . $scheduler->getRoom()->getId();
            $json["start"] = $scheduler->getStart()->format('Y-m-d');
            $json["end"] = $scheduler->getEnd()->format('Y-m-d');
            $json["title"] = $scheduler->getId(); // $scheduler->getDescription();
            $json["overlap"] = true;
            $json["editatable"] = true;
            $jsonarr[] = $json;
        }


        return new Response(
                json_encode($jsonarr), 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/scheduler/resources")
     * 
     */
    public function resourcesAction() {
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('BookingBundle:RoomCategory')->findAll();
        $request = Request::createFromGlobals();

        $start = $request->query->get("start");
        $end = $request->query->get("end");

        foreach (@(array) $results as $roomCategory) {
            $json["id"] = "RC-" . $roomCategory->getId();
            ;
            $json["title"] = $roomCategory->getTitle();
            $jsonchildrenarr = array();

            $start = '2016-01-01';
            $end = '2016-02-01';
            $json["children"] = array();
            foreach ($roomCategory->getRooms() as $room) {
                $jsonchildren["id"] = $roomCategory->getId() . "-" . $room->getId();
                $jsonchildren["title"] = $room->getDescription();
                $jsonchildrenarr[] = $jsonchildren;
            }
            $json["children"] = $jsonchildrenarr;
            $jsonarr[] = $json;
        }

        return new Response(
                json_encode($jsonarr), 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/scheduler/event")
     * 
     */
    public function eventAction() {

        $request = Request::createFromGlobals();
        $resource = explode("-",$request->request->get("resourceId"));   
        if ($resource[1] == 0) return;
             
        $entity = $this->getDoctrine()
                ->getRepository($this->repository)
                ->find($request->request->get("id"));

        $start = $request->request->get("start");
        $end = $request->request->get("end");
        
        if ($start == $end) {
            $end = date("Y-m-d",(strtotime($end)+86400));
        }
        
        if ($request->request->get("id") == 0 AND @ $entity->id == 0) {
            $dt = new \DateTime("now");
            $entity = new Scheduler;
            $entity->setTs($dt);
            $entity->setCreated($dt);
            $entity->setModified($dt);
            $entity->setStatus(1);
            $entity->setStart(new \DateTime($start));
            $entity->setEnd(new \DateTime($end));
            $entity->setDescription($request->request->get("title"));
            $entity = $this->flushpersist($entity);
        }

        $room = $this->getDoctrine()
                ->getRepository('BookingBundle:Room')
                ->find($resource[1]);

        $entity->setStart(new \DateTime($start));
        $entity->setEnd(new \DateTime($end));
        $entity->setRoom($room);
        $out = '[' . $room->getId() . ']';
        $this->flushpersist($entity);

        $out = '[]';
        return new Response(
                $out, 200, array('Content-Type' => 'application/json')
        );
    }

}
