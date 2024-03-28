<?php

namespace App\Controller;

use App\Entity\Forecast;
use App\Entity\Location;
use App\Form\LocationSearchType;
use App\Repository\LocationRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name: 'app_location')]
class LocationController extends AbstractController
{
    #[Route('/home/{city}', name: "_home", defaults:['city' => 'Berlin'])]
    public function home(Request $request, LocationRepository $locationRepository, string $city = null): Response
    {
        $city_form = $city;

        $location = new Location();
        $formSearch = $this->createForm(
            LocationSearchType::class,
            $location
        );

        $formSearch->handleRequest($request);


        if ($formSearch->isSubmitted() && $formSearch->isValid()) {

            $data = $request->get('location_search');
            $city_form = $data['input_search'];

            $location = $locationRepository->findOneByName($city_form, "2024-03-28 12:00:00");

            $json_location = [];

            $json_location = [
                "city" => $location->getCity(),
                'lat' => $location->getLatitude(),
                'long' => $location->getLatitude(),
                'city' => $location->getCity(),
                'country' => $location->getCountryName(),
            ];

            $forecasts = $location->getForecasts();

            foreach ($forecasts as $forecast) {
                $json_location["forecast"] = [
                    "temperature" => $forecast->getTemperature(),
                    "pressure" => $forecast->getPressure(),
                    "sun" => $forecast->isSun(),
                    "window_speed" => $forecast->getWindSpeed(),
                    "rain" => $forecast->isRain(),
                    "snow" => $forecast->isSnow(),
                    "cloud" => $forecast->isCloud(),
                    "date" => $forecast->getDate(),
                ];
            }

            return $this->redirectToRoute('app_location_home', [ "city" => $city_form ], Response::HTTP_SEE_OTHER);
        }

        $location = $locationRepository->findOneByName($city_form, "2024-03-28 12:00:00");
         
        dump($location);
        die();

        $json_location = [];

        $json_location = [
            "city" => $location->getCity(),
            'lat' => $location->getLatitude(),
            'long' => $location->getLatitude(),
            'city' => $location->getCity(),
            'country' => $location->getCountryName(),
        ];

        $forecasts = $location->getForecasts();

        foreach ($forecasts as $forecast) {
            $json_location["forecast"] = [
                "temperature" => $forecast->getTemperature(),
                "pressure" => $forecast->getPressure(),
                "sun" => $forecast->isSun(),
                "window_speed" => $forecast->getWindSpeed(),
                "rain" => $forecast->isRain(),
                "snow" => $forecast->isSnow(),
                "cloud" => $forecast->isCloud(),
                "date" => $forecast->getDate(),
            ];
        }


        return $this->render('location/home.html.twig', [
            'form' => $formSearch,
            'lat' => $json_location['lat'],
            'long' => $json_location['long'],
            'city' => $json_location['city'],
            'country' => $json_location['country'],
            "temperature" => $json_location['forecast']['temperature'],
            "pressure" => $json_location['forecast']['pressure'],
            "sun" => $json_location['forecast']['sun'],
            "window_speed" => $json_location['forecast']['window_speed'],
            "rain" => $json_location['forecast']['rain'],
            "snow" => $json_location['forecast']['snow'],
            "cloud" => $json_location['forecast']['cloud'],
            "date" => $json_location['forecast']['date'],
        ]);
    }

    #[Route('/json/all', name: '_all')]
    public function index(LocationRepository $locationRepository): JsonResponse
    {
        $location = $locationRepository->getAll();
        $json = [];

        foreach ($location as $area) {
            $forecasts = $area->getForecasts();

            foreach ($forecasts as $forecast) {
                $json["forecast_" . $area->getId() . "_" . $forecast->getId()]  = [
                    "city" => $area->getCity(),
                    'countryName' => $area->getCountryName(),
                    'latitude' => $area->getLatitude(),
                    'longitude' => $area->getLongitude(),
                    "location" => $area->getId(),
                    "temperature" => $forecast->getTemperature(),
                    "pressure" => $forecast->getPressure(),
                    "cloud" => $forecast->isCloud(),
                    "sun" => $forecast->isSun(),
                    "rain" => $forecast->isRain(),
                    "snow" => $forecast->isSnow(),
                    "date" => $forecast->getDate(),
                ];
            }
        }

        return $this->json($json);
    }
}
