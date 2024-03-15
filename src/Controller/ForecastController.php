<?php

namespace App\Controller;

use Random\Randomizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



class ForecastController extends AbstractController
{
    protected $cities;
    protected $dummy_data;
    protected $weather_forecast;
    protected $navigation;
    protected $randomizer;

    public function __construct()
    {

        $this->randomizer = new \Random\Randomizer();
        $this->weather_forecast = 'Weather Forecast';
        $this->navigation = [
            'locations' => [
                'PL' => [
                    'Stettin' => '/forecast/PL/Stettin',
                    'Cracow' => '/forecast/PL/Cracow',
                    'Warsaw' => '/forecast/PL/Warsaw',
                ],
                'DE' => [
                    'Berlin' => '/forecast/DE/Berlin',
                    'Munich' => '/forecast/DE/Munich',
                ]
            ]
        ];
        
        $this->dummy_data = [
            0 => [
                'weekDayName' => 'Monday',
                'date' => '2024-01-01',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' =>  $this->randomizer->getFloat(1,100),
                'cloudines' => random_int(0, 100),
                'icon' => 'cloud-rain-heavy',
            ],
            1 => [
                'weekDayName' => 'Tuesday',
                'date' => '2024-01-02',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' =>  $this->randomizer->getFloat(1,100),
                'cloudines' => random_int(0, 100),
                'icon' => 'cloud',
            ],
            2 => [
                'weekDayName' => 'Wednesday',
                'date' => '2024-01-03',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' =>  $this->randomizer->getFloat(1,100),
                'cloudines' => random_int(0, 100),
                'icon' => 'storm',
            ],
            3 => [
                'weekDayName' => 'Monday',
                'date' => '2024-01-01',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' =>  $this->randomizer->getFloat(1,100),
                'cloudines' => random_int(0, 100),
                'icon' => 'sun',
            ],
            4 => [
                'weekDayName' => 'Tuesday',
                'date' => '2024-01-02',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' =>  $this->randomizer->getFloat(1,100),
                'cloudines' => random_int(0, 100),
                'icon' => 'cloud-lightning-rain-fill',
            ],
            5 => [
                'weekDayName' => 'Wednesday',
                'date' => '2024-01-03',
                'temperature' => random_int(-50, 50),
                'feels_like' => random_int(-60, 60),
                'pressure' => random_int(960, 1030),
                'humidity' => random_int(0, 100),
                'wind' =>  $this->randomizer->getFloat(1,100),
                'cloudines' => random_int(0, 100),
                'icon' => 'cloud-drizzle',
            ]
        ];
    }

    #[Route('/forecast/{cc}/{city}', name: 'forecast')]
    public function index(Request $request, string $cc = 'PL', string $city ='Warsaw'): Response
    {
        $gen_forecast = array();
        $locations = $this->navigation['locations'];
        
        foreach( $locations as $cc_key => $city_value ) {
            foreach( $city_value as $city_key => $link ) {
                $gen_forecast[$cc_key][$city_key] = [
                    'forecast' => $this->dummy_data,
                ];
            }
        }

        $forecast = $gen_forecast[$cc][$city]['forecast'];

        // dump( $gen_forecast);
        // die();

        return $this->render('forecast/index.html.twig', [
            'title_app' =>  $this->weather_forecast,
            'navigation' => $this->navigation,
            'cc' => $cc,
            'city' => $city,
            'forecast' => $forecast,
        ]);
    }
}
