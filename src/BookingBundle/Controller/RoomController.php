<?php

namespace BookingBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\Main;
use BookingBundle\Entity\Room as Room;

class RoomController extends Main {

    var $repository = 'BookingBundle:Room';
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
     * @Route("/room/view/{id}")
     */
    public function viewAction($id) {

        $buttons = array();
        $content = $this->gettabs($id);
        //$content = $this->getoffcanvases($id);

        $content = $this->content();

        return $this->render('BookingBundle:Room:view.html.twig', array(
                    'pagename' => 'Room',
                    'url' => '/room/save',
                    'buttons' => $buttons,
                    'ctrl' => $this->generateRandomString(),
                    'app' => $this->generateRandomString(),
                    'content' => $content,
                    'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..'),
        ));
    }

    /**
     * @Route("/room/save")
     */
    public function savection() {
        $entity = new Room;
        $this->initialazeNewEntity($entity);
        $this->newentity[$this->repository]->setField("status", 1);
        $out = $this->save();
        $jsonarr = array();
        if ($this->newentity[$this->repository]->getId()) {
            $jsonarr["returnurl"] = "/room/view/" . $this->newentity[$this->repository]->getId();
        }
        $json = json_encode($jsonarr);
        return new Response(
                $json, 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/room/gettab")
     */
    public function gettabs($id) {

        $entity = $this->getDoctrine()
                ->getRepository($this->repository)
                ->find($id);
        if ($id == 0 AND @ $entity->id == 0) {
            $entity = new Room;
            $this->newentity[$this->repository] = $entity;
        }
        $fields["description"] = array("label" => "Room Code");


        $forms = $this->getFormLyFields($entity, $fields);
        $this->addTab(array("title" => "General1", "form" => $forms, "content" => '', "index" => $this->generateRandomString(), 'search' => 'text', "active" => true));
        $json = $this->tabs();
        return $json;
    }

    /**
     * @Route("/room/getdatatable")
     */
    public function getdatatableAction(Request $request) {
        $this->repository = 'BookingBundle:Room';
        $this->addField(array("name" => "ID", "index" => 'id'))
                ->addField(array("name" => "Name", "index" => 'description', 'search' => 'text'));

        $json = $this->datatable();
        return new Response(
                $json, 200, array('Content-Type' => 'application/json')
        );
    }

}
