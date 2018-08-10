<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WeatherController extends Controller {

    /**
     * @Route("/weather/", name="weather")
     */
    public function index(Request $request) {

        $parameters = [];

        return $this->render('weather/index.html.twig', $parameters);
    }

}
