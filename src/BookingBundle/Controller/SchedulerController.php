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
        $results = $em->getRepository('BookingBundle:Room')->findAll();

        foreach (@(array) $results as $room) {
            for ($i = $startTime; $i <= $endTime; $i = $i + 86400) {

                $thisDate = date('Y-m-d', $i);

                $query = $em->createQuery('SELECT p.id FROM BookingBundle:Scheduler p WHERE p.room = '.$room->getId().' AND p.start <= :date AND p.end >= :date')
                        ->setParameter('date', $thisDate)
                        ;

                $books = $query->getResult();

                $json = array();
                $d = $room->getAmount()-count($books);
                $json["id"] = "A" . $room->getId() . $i;
                $json["resourceId"] = $room->getId();
                $json["start"] = $thisDate;
                $json["end"] = $thisDate;
                $json["title"] = "A:".$d;
                $json["overlap"] = true;
                $json["editatable"] = false;
                $json["backgroundColor"] = '#ff8000';
                
                $jsonarr[] = $json;

                $json = array();
                $json["id"] = "B" . $room->getId() . $i;
                $json["resourceId"] = $room->getId();
                $json["start"] = $thisDate;
                $json["end"] = $thisDate;
                $json["title"] = "B:".count($books);
                $json["overlap"] = true;
                $json["editatable"] = false;
                $json["dragable"] = false;
                $jsonarr[] = $json;
            }
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
        $results = $em->getRepository('BookingBundle:Room')->findAll();
        $request = Request::createFromGlobals();
        
        $start = $request->query->get("start");
        $end = $request->query->get("end");
        
        foreach (@(array) $results as $room) {
            $json["id"] = $room->getId();
            ;
            $json["title"] = $room->getDescription()." (".$room->getAmount().")";
            $jsonchildrenarr = array();
            
            $start = '2016-01-01';
            $end = '2016-02-01';
            
            //$query = $em->createQuery('SELECT p.id FROM BookingBundle:Scheduler p WHERE p.room = '.$room->getId().' AND p.start <= "'.$start.'" AND p.end >= "'.$end.'"');
         
            for($i=1; $i <= $room->getAmount(); $i++) {
                $jsonchildren["id"] = $room->getId()."-".$i;
                $jsonchildren["title"] = $room->getDescription()." #".$i;
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
        /*
          $request = Request::createFromGlobals();
          $entity = $this->getDoctrine()
          ->getRepository($this->repository)
          ->find($request->request->get("id"));

          if ($request->request->get("id") == 0 AND @ $entity->id == 0) {
          $dt = new \DateTime("now");
          $entity = new Scheduler;
          $entity->setTs($dt);
          $entity->setCreated($dt);
          $entity->setModified($dt);
          $entity->setStatus(1);
          $entity->setStart(new \DateTime($request->request->get("start")));
          $entity->setEnd(new \DateTime($request->request->get("end")));
          $entity->setDescription($request->request->get("title"));
          $entity = $this->flushpersist($entity);
          }

          $room = $this->getDoctrine()
          ->getRepository('BookingBundle:Room')
          ->find($request->request->get("resourceId"));

          $entity->setStart(new \DateTime($request->request->get("start")));
          $entity->setEnd(new \DateTime($request->request->get("end")));
          $entity->setRoom($room);
          $out = '[' . $room->getId() . ']';
          $this->flushpersist($entity);
         */
        $out = '[]';
        return new Response(
                $out, 200, array('Content-Type' => 'application/json')
        );
    }

}
