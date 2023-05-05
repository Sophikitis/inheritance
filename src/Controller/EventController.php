<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventPlanning;
use App\Entity\Products;
use App\Form\EventType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/', name: 'app_event')]
    public function index(Request $request, EntityManagerInterface $entity): Response
    {


		$event = new Event();

//		$eventPlanning = new EventPlanning();

//		$event->addEventsPlanning($eventPlanning);
//
	    $form = $this->createForm(EventType::class, $event);
	    $form->handleRequest($request);
	    if ($form->isSubmitted() && $form->isValid()) {
			dd($event);

	    }

		$this->container->get('twig')->addGlobal('eventType', 'sport');
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
	        'form' => $form,
        ]);
    }
}
