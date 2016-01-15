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

        $em = $this->getDoctrine()->getManager();

        $results = $em->getRepository($this->repository)->findAll();
        foreach (@(array) $results as $result) {
            $json["id"] = $result->getId();
            $json["resourceId"] = $result->getRoom()->getId();
            $json["start"] = $result->getStart()->format('Y-m-d');
            $json["end"] = $result->getEnd()->format('Y-m-d');
            $json["title"] = $result->getDescription();
            $json["description"] = "A";
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
        $results = $em->getRepository('BookingBundle:Room')->findAll();
        foreach (@(array) $results as $result) {
            $json["id"] = $result->getId();
            ;
            $json["title"] = $result->getDescription();
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
            $entity->getDescription(new \DateTime($request->request->get("title")));
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

        return new Response(
                $out, 200, array('Content-Type' => 'application/json')
        );
    }

}
