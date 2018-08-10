<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TankMapController extends Controller {

    /**
     * @Route("/tank_map/", name="tank_map")
     */
    public function index(Request $request) {
        $entityManager = $this->getDoctrine()->getManager();
        
        return $this->render('tank_map/index.html.twig', [
            'tankMarkers' => $entityManager->getRepository("App\Entity\Tank")->findAll(),
        ]);
    }

}
