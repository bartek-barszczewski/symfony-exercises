<?php

namespace App\Controller;

use Random\Randomizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class WeatherForecastController extends AbstractController
{
    protected $cities;
    protected $dummy_data;

    public function __construct()
    {
        $randomizer = new Randomizer();
        $this->cities = ['Szczecin', 'Warszawa', 'Krakow', 'Olsztyn', 'Wroclaw', 'Poznan'];
        $this->dummy_data = [
            0 => [
                'date' => '2024-01-01',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                
                'cloudines' => random_int(0, 100),
                'icon' => 'sun%',
            ],
            1 => [
                'date' => '2024-01-02',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                
                'cloudines' => random_int(0, 100),
                'icon' => 'sun%',
            ],
            2 => [
                'date' => '2024-01-03',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                
                'cloudines' => random_int(0, 100),
                'icon' => 'sun%',
            ]
        ];
    }

    #[Route('/weather/forecast/1', name: 'forecast')]
    public function index(
        // Request $request,
        // RequestStack $reqStack,
        // string $cc,
        // string $city,
        // string $_format = 'html',

    ): Response {
        // $session = $reqStack->getSession();

        // if (!in_array($city, $this->cities)) {
        //     throw new \Exception("Sorry, the city: " . $city . " not exist in array");
        // }

        // $session->set("cc", $cc);
        // $session->set("city", $city);

        // $forecast_json_view = $this->renderView("weather_forecast/index.{$_format}.twig", [
        //     'cc' => $cc,
        //     'city' => $city,
        //     'forecast' => $this->dummy_data,
        // ]);

        // $response = new Response($forecast_json_view);
        
        return $this->render("weather_forecast/index.html.twig");
    }

    #[Route('/weather/forecast/2', name: 'forecast_session')]
    public function index_session(RequestStack $reqStack): Response
    {
        $session = $reqStack->getSession();

        return $this->render('weather_forecast/forecast.html.twig', [
            'cc' => $session->get("cc"),
            'city' => $session->get('city')
        ]);
    }
}
