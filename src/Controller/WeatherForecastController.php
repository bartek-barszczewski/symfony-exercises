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
                'wind' => $randomizer->getFloat(0, 100),
                'cloudines' => random_int(0, 100),
                'icon' => 'sun%',
            ],
            1 => [
                'date' => '2024-01-02',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' => $randomizer->getFloat(0, 100),
                'cloudines' => random_int(0, 100),
                'icon' => 'sun%',
            ],
            2 => [
                'date' => '2024-01-03',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' => $randomizer->getFloat(0, 100),
                'cloudines' => random_int(0, 100),
                'icon' => 'sun%',
            ]
        ];
    }

    #[Route('/weather/forecast/{cc}/{city}', name: 'forecast')]
    public function index(
        Request $request,
        RequestStack $reqStack,
        string $cc,
        string $city

    ): Response {
        $session = $reqStack->getSession();

        if (!in_array($city, $this->cities)) {
            throw new \Exception("Sorry, the city: " . $city . " not exist in array");
        }

        $session->set("cc", $cc);
        $session->set("city", $city);

        return $this->render('weather_forecast/index.html.twig', [
            'dummy_data' => $this->dummy_data,
            'cc' => $cc,
            'city' => $city,
        ]);
    }

    #[Route('/weather/forecast/session', name: 'forecast_session')]
    public function index_session(RequestStack $reqStack): Response
    {
        $session = $reqStack->getSession();

        return $this->render('weather_forecast/index_session.html.twig', [
            'cc' => $session->get("cc"),
            'city' => $session->get('city')
        ]);
    }
}
