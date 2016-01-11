<?php

namespace BookingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class SchedulerController extends Controller {

    /**
     * @Route("/scheduler/events")
     * 
     */
    public function eventsAction() {
        $out = '[
        { "id": "1", "resourceId": "a", "start": "2016-01-06", "end": "2016-01-18", "title": "event 1" },
        { "id": "2", "resourceId": "b", "start": "2016-01-06", "end": "2016-01-13", "title": "event 2" },
	{ "id": "3", "resourceId": "d", "start": "2016-01-06", "end": "2016-01-08", "title": "event 3" }
        ]';
        return new Response(
                $out, 200, array('Content-Type' => 'application/json')
        );
    }

    /**
     * @Route("/scheduler/resources")
     * 
     */
    public function resourcesAction() {
        $out = '[
	{ "id": "a", "title": "Auditorium A" },
	{ "id": "b", "title": "Auditorium B", "eventColor": "green" },
	{ "id": "c", "title": "Auditorium C", "eventColor": "orange" },
	{ "id": "d", "title": "Auditorium D", "children": [
		{ "id": "d1", "title": "Room D1" },
		{ "id": "d2", "title": "Room D2" }
	] },
	{ "id": "e", "title": "Auditorium E" },
	{ "id": "f", "title": "Auditorium F", "eventColor": "red" },
	{ "id": "g", "title": "Auditorium G" },
	{ "id": "h", "title": "Auditorium H" },
	{ "id": "i", "title": "Auditorium I" },
	{ "id": "j", "title": "Auditorium J" },
	{ "id": "k", "title": "Auditorium K" },
	{ "id": "l", "title": "Auditorium L" },
	{ "id": "m", "title": "Auditorium M" },
	{ "id": "n", "title": "Auditorium N" },
	{ "id": "o", "title": "Auditorium O" },
	{ "id": "p", "title": "Auditorium P" },
	{ "id": "q", "title": "Auditorium Q" },
	{ "id": "r", "title": "Auditorium R" },
	{ "id": "s", "title": "Auditorium S" },
	{ "id": "t", "title": "Auditorium T" },
	{ "id": "u", "title": "Auditorium U" },
	{ "id": "v", "title": "Auditorium V" },
	{ "id": "w", "title": "Auditorium W" },
	{ "id": "x", "title": "Auditorium X" },
	{ "id": "y", "title": "Auditorium Y" },
	{ "id": "z", "title": "Auditorium Z" }]';
        return new Response(
                $out, 200, array('Content-Type' => 'application/json')
        );
    }

}
