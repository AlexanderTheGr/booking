<?php

namespace BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use BookingBundle\Entity\RoomCategorySeason as RoomCategorySeason;
use BookingBundle\Entity\RoomSeason as RoomSeason;
use AppBundle\Controller\Main;

class SeasonController extends Main {

    var $repository = 'BookingBundle:RoomCategorySeason';
    var $newentity = '';

    /**
     * @Route("/room/room")
     */
    public function indexAction() {
        return $this->render('BookingBundle:Room:index.html.twig', array(
                    'pagename' => 'Rooms',
                    'url' => '/room/getdatatable',
                    'view' => '/room/view',
                    'ctrl' => $this->generateRandomString(),
                    'app' => $this->generateRandomString(),
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    /**
     * @Route("/season/events")
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

        $jsonarr = array();
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('BookingBundle:RoomCategorySeason')->findAll();
        foreach (@(array) $results as $season) {
            $json = array();

            $start = strtotime($season->getStart()->format('Y-m-d'));
            $end = strtotime($season->getEnd()->format('Y-m-d'));
            $go = true;
            if ($startTime >= $start AND $startTime >= $end) {
                $go = false;
            }
            if ($endTime <= $start AND $endTime <= $end) {
                $go = false;
            }
            $go = true;
            if ($go) {
                $json["id"] = "RoomCategory-" . $season->getId();
                $json["resourceId"] = "RoomCategory-" . $season->getRoomCategory()->getId();
                $json["start"] = $season->getStart()->format('Y-m-d');
                $json["end"] = $season->getEnd()->format('Y-m-d');
                $json["title"] = $season->getId(); // $season->getDescription();
                $json["overlap"] = true;
                $json["overlap"] = false;
                $json["editable"] = true;
                $json["class"] = "RoomCategory";
                $jsonarr[] = $json;
            }
        }

        $results = $em->getRepository('BookingBundle:RoomSeason')->findAll();
        foreach (@(array) $results as $season) {
            $json = array();
            $start = strtotime($season->getStart()->format('Y-m-d'));
            $end = strtotime($season->getEnd()->format('Y-m-d'));
            $go = true;
            if ($startTime >= $start AND $startTime >= $end) {
                $go = false;
            }
            if ($endTime <= $start AND $endTime <= $end) {
                $go = false;
            }
            if ($go) {
                $json["id"] = "Room-" . $season->getId();
                $json["resourceId"] = "Room-" . $season->getRoom()->getId();
                $json["start"] = $season->getStart()->format('Y-m-d');
                $json["end"] = $season->getEnd()->format('Y-m-d');
                $json["title"] = $season->getId(); // $season->getDescription();
                $json["overlap"] = true;
                $json["overlap"] = false;
                $json["editable"] = true;
                $json["class"] = "Room";
                $json["backgroundColor"] = '#af8000';
                $jsonarr[] = $json;
            }
        }


        return new Response(
                json_encode($jsonarr), 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/season/resources")
     * 
     */
    public function resourcesAction() {
        $em = $this->getDoctrine()->getManager();
        $results = $em->getRepository('BookingBundle:RoomCategory')->findAll();
        $request = Request::createFromGlobals();

        $start = $request->query->get("start");
        $end = $request->query->get("end");

        foreach (@(array) $results as $roomCategory) {
            $json["id"] = "RoomCategory-" . $roomCategory->getId();

            $json["title"] = $roomCategory->getTitle();
            $jsonchildrenarr = array();

            $json["children"] = array();
            foreach ($roomCategory->getRooms() as $room) {
                $jsonchildren["id"] = "Room-" . $room->getId();
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
     * @Route("/season/resource/{id}")
     * 
     */
    public function resourceAction($id) {
        $em = $this->getDoctrine()->getManager();
        //$results = $em->getRepository('BookingBundle:RoomCategory')->findAll();
        $request = Request::createFromGlobals();

        $start = $request->query->get("start");
        $end = $request->query->get("end");

        $roomCategory = $this->getDoctrine()
                ->getRepository("BookingBundle:RoomCategory")
                ->find($id);

        $json["id"] = "RoomCategory-" . $roomCategory->getId();

        $json["title"] = $roomCategory->getTitle();
        $jsonchildrenarr = array();

        $json["children"] = array();
        foreach ($roomCategory->getRooms() as $room) {
            $jsonchildren["id"] = "Room-" . $room->getId();
            $jsonchildren["title"] = $room->getDescription();
            $jsonchildrenarr[] = $jsonchildren;
        }
        $json["children"] = $jsonchildrenarr;
        $jsonarr[] = $json;


        return new Response(
                json_encode($jsonarr), 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/season/eventEdit")
     * 
     */
    public function eventEditAction() {

        $buttons = array();
        $content = $this->gettabs(0);
        //$content = $this->getoffcanvases($id);
        //$content = $this->content();

        return $this->render('BookingBundle:Season:view.html.twig', array(
                    'pagename' => 'Room',
                    'url' => '/room/save',
                    'buttons' => $buttons,
                    'ctrl' => $this->generateRandomString(),
                    'app' => $this->generateRandomString(),
                    'content' => $content,
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    public function gettabs($id=0) {
        $entity = $this->getDoctrine()
                ->getRepository($this->repository)
                ->find($id);
        if ($id == 0 AND @ $entity->id == 0) {
            $entity = new RoomCategorySeason;
            $this->newentity[$this->repository] = $entity;
        }
        $fields["description"] = array("label" => "Value");
        $forms = $this->getFormLyFields($entity, $fields);
        $this->addTab(array("title" => "General", "form" => $forms, "content" => '', "index" => $this->generateRandomString(), 'search' => 'text', "active" => true));
        $json = $this->tabs();
        return $json;
    }

    /**
     * @Route("/season/event")
     * 
     */
    public function eventAction() {

        $request = Request::createFromGlobals();
        $start = $request->request->get("start");
        $end = $request->request->get("end");
        if ($start == $end) {
            $end = date("Y-m-d", (strtotime($end) + 86400));
        }


        $resource = explode("-", $request->request->get("resourceId"));
        if ($resource[1] == 0)
            return;

        $sr = $resource[0];
        if ($request->request->get("class") != '' AND $sr != $request->request->get("class")) {
            $out = '[]';
            return new Response(
                    $out, 200, array('Content-Type' => 'application/json')
            );
        }

        $this->repository = 'BookingBundle:' . $sr . 'Season';
        //$setSt = "set".$sr;


        $res = explode("-", $request->request->get("id"));

        $entity = $this->getDoctrine()
                ->getRepository($this->repository)
                ->find((int) @$res[1]);

        if (@$res[1] == 0 AND @ $entity->id == 0) {
            $dt = new \DateTime("now");
            $en = $sr . 'Season';
            if ($en == 'RoomSeason')
                $entity = new RoomSeason;
            if ($en == 'RoomCategorySeason')
                $entity = new RoomCategorySeason;


            $entity->setValue(0);
            $entity->setTs($dt);
            $entity->setCreated($dt);
            $entity->setModified($dt);
            $entity->setStatus(1);
            $entity->setStart(new \DateTime($start));
            $entity->setEnd(new \DateTime($end));
            $entity->setDescription($request->request->get("title"));
            $entity = $this->flushpersist($entity);
        }
        $obj = $this->getDoctrine()
                ->getRepository('BookingBundle:' . $sr)
                ->find($resource[1]);
        if (!$entity) {
            $out = '[]';
            return new Response(
                    $out, 200, array('Content-Type' => 'application/json')
            );
        };
        $entity->setStart(new \DateTime($start));
        $entity->setEnd(new \DateTime($end));
        $entity->setField($sr, $obj);
        $out = '[' . $obj->getId() . ']';
        $this->flushpersist($entity);

        $out = '[]';
        return new Response(
                $out, 200, array('Content-Type' => 'application/json')
        );
    }

}
