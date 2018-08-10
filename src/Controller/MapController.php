<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends Controller {

    /**
     * @Route("/map/", name="map")
     */
    public function index(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        
        return $this->render('map/index.html.twig', [
            'notificationMarkers' => $entityManager->getRepository("App\Entity\Notification")->findAll(),
            'maintenanceMarkers' => $entityManager->getRepository("App\Entity\Maintenance")->findAll()
        ]);
    }

}
