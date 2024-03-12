<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class WeatherController extends AbstractController
{

    #[Route("/weather/{countryCode}/{country}", name: "country_code")]
    public function country_weather(string $countryCode, string $country): Response {
        return $this->render("weather/index.html.twig", [
            'cc' => $countryCode,
            'country' => $country,
        ]);
    }

    #[Route('/forecast/{threshold<\d+>?50}', methods: ['GET', 'POST'], host: "api.localhost" )]
    public function forecast_json(int $threshold = 50): Response
    {

        
        $forecast = $threshold < 50 ? "It's going to be cold" : "It's going to be warm";

        $forecast = [
            'forecast' => $forecast,
            'self' => $this->generateUrl('forecast', [ 'threshold' => 12 ], UrlGeneratorInterface::ABSOLUTE_URL ),
        ];

        return new JsonResponse( $forecast );
    }


    #[Route('/forecast/{threshold<\d+>?50}', methods: ['GET', 'POST'], name: "forecast" )]
    public function forecast(int $threshold = 50): Response
    {
        $forecast = $threshold < 50 ? "It's going to be cold" : "It's going to be warm";

        return $this->render('weather/index.html.twig', [
            'forecast' => $forecast,
        ]);
    }

    
    #[Route('/forecast/{guess}', methods: ['GET', 'POST'], name: "forecast_guess")]
    public function forecast_weather(string $guess, Request $request): Response
    {
        $trials = $request->get('trials', default: 1);
        echo $trials;
        die();
        $weather_available = ['snow', 'sunny', 'rain', 'hail'];

        if(!in_array($guess, $weather_available ) ) {

            #throw $this->createNotFoundException("This guess not found... ");
            #throw new NotFoundHttpException('This guess is not found');
            
            throw new \Exception("Base exception");
        }

        $forecast = "It's going to be " . $guess;

        return $this->render('weather/index.html.twig', [
            'forecast' => $forecast,
        ]);
    }

    #[Route('/forecast/redirect', name: 'redirect')]
    public function redirect_forecast(): RedirectResponse {

        return $this->redirectToRoute('forecast', [], 302 );
    }

}
