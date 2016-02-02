<?php

namespace BookingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Main;
use BookingBundle\Entity\RoomCategory as RoomCategory;

class RoomCategoryController extends Main {

    var $repository = 'BookingBundle:RoomCategory';
    var $newentity = '';

    /**
     * @Route("/roomCategory/roomCategory")
     */
    public function indexAction() {
        return $this->render('BookingBundle:RoomCategory:index.html.twig', array(
                    'pagename' => 'RoomCategorys',
                    'url' => '/roomCategory/getdatatable',
                    'view' => '/roomCategory/view',
                    'ctrl' => $this->generateRandomString(),
                    'app' => $this->generateRandomString(),
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    /**
     * @Route("/roomCategory/view/{id}")
     */
    public function viewAction($id) {

        $buttons = array();
        $content = $this->gettabs($id);
        //$content = $this->getoffcanvases($id);
        $roomCategory = $this->getDoctrine()
                ->getRepository("BookingBundle:RoomCategory")
                ->find($id);
        $content = $this->content();
        return $this->render('BookingBundle:RoomCategory:view.html.twig', array(
                    'pagename' => "Room Category: " . $roomCategory->getDescription(),
                    'url' => '/roomCategory/save',
                    'buttons' => $buttons,
                    'ctrl' => $this->generateRandomString(),
                    'app' => $this->generateRandomString(),
                    'content' => $content,
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    /**
     * @Route("/roomCategory/save")
     */
    public function savection() {
        $entity = new RoomCategory;
        $this->initialazeNewEntity($entity);
        $this->newentity[$this->repository]->setField("status", 1);
        $out = $this->save();
        $jsonarr = array();
        if ($this->newentity[$this->repository]->getId()) {
            $jsonarr["returnurl"] = "/roomCategory/view/" . $this->newentity[$this->repository]->getId();
        }
        $json = json_encode($jsonarr);
        return new Response(
                $json, 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/roomCategory/gettab")
     */
    public function gettabs($id) {

        $entity = $this->getDoctrine()
                ->getRepository($this->repository)
                ->find($id);
        if ($id == 0 AND @ $entity->id == 0) {
            $entity = new RoomCategory;
            $this->newentity[$this->repository] = $entity;
        }

        $fields["title"] = array("label" => "title");
        $fields["description"] = array("label" => "Description");
        $dtparams[] = array("name" => "ID", "index" => 'id');
        $dtparams[] = array("name" => "Name", "index" => 'description', 'search' => 'text');
        $dtparams[] = array("name" => "Number", "index" => 'number', "input" => "text", 'search' => 'text');
        $dtparams[] = array("name" => "Name", "index" => 'RoomCategory:title', 'search' => 'text');
        $params['dtparams'] = $dtparams;
        $params['id'] = $dtparams;
        $params['key'] = 'gettabs_' . $id;
        $params['url'] = '/roomCategory/getrooms/' . $id;
        $params["ctrl"] = 'ctrlgettabs';
        $params["view"] = '/roomCategory/view';
        $params["app"] = 'appgettabs';
        $datatables[] = $this->contentDatatable($params);
        $calendar["id"] = $this->generateRandomString();
        $calendar["resources"] = '/season/resource/' . $id;
        $calendar["events"] = '/season/events';
        $calendar["event"] = '/season/event';
        
        $calendar["eventClick"] = "eventClickSeason";
        $calendar["dayClick"] = "dayClickSeason";



        $forms = $this->getFormLyFields($entity, $fields);
        $forms1 = "";//$this->getFormLyFields($entity, $fields, 'asddialog');
        $this->addTab(array("title" => "General", "form" => $forms, "content" => '', "index" => $this->generateRandomString(), 'search' => 'text', "active" => true));
        if ($entity->getId()) {
            $this->addTab(array("title" => "Rooms", "datatables" => $datatables, "form" => '', "content" => '', "index" => $this->generateRandomString(), 'search' => 'text', "active" => false));
            $this->addTab(array("title" => "Seasons", "form" => '', "calendar" => $calendar, "content" => "", "index" => $this->generateRandomString(), 'search' => 'text', "active" => false));
        }

        $json = $this->tabs();
        return $json;
    }

    /**
     * @Route("/roomCategory/getrooms/{id}")
     */
    public function getroomsAction($id) {
        $session = new Session();
        foreach ($session->get('params_gettabs_' . $id) as $param) {
            $this->addField($param);
        }
        $this->repository = 'BookingBundle:Room';
        $this->q_and[] = $this->prefix . ".RoomCategory = " . $id;
        $json = $this->datatable();
        return new Response(
                $json, 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/roomCategory/getdatatable")
     */
    public function getdatatableAction(Request $request) {
        $this->repository = 'BookingBundle:RoomCategory';
        $this->addField(array("name" => "ID", "index" => 'id'))
                ->addField(array("name" => "Name", "index" => 'title', 'search' => 'text'));

        $json = $this->datatable();
        return new Response(
                $json, 200, array('Content-Type' => 'application/json')
        );
    }

}
