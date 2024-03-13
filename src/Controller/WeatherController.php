<?php

declare(strict_types=1);

namespace App\Controller;

use App\RequestModel\ForecastModelDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;


class WeatherController extends AbstractController
{
    #[Route('/forecast/api', host: "api.localhost")]
    public function forecast_json(
        // #[MapQueryString] ?ForecastModelDTO $fmodel = null

        // 
    ): Response
    {

        // if(!$fmodel) {
        //     $fmodel = new ForecastModelDTO();
        //     $fmodel->email = "xx@xx.xx";
        //     $fmodel->threshold = 50;
        //     $fmodel->trials = 1;
        // }   

        // for($x = 0; $x < $fmodel->trials; $x++) {
        //     $degrees = random_int(0, 100);
        //     $forecast = $degrees < $fmodel->threshold ? "It's going to be cold" : "It's going to be warm";
        //     $forecasts[] = $forecast;
        // }

        // $forecast = [
        //     'forecast' => $forecast,
        //     ['forecasts' => $forecasts],
        //     'self' => $this->generateUrl('forecast', [ 'threshold' => 12 ], UrlGeneratorInterface::ABSOLUTE_URL ),
        //     'email' => $fmodel->email,
        // ];

        // return new JsonResponse( $forecast );

        // return $this->file(__DIR__ . "/a.png");

        return $this->file(__DIR__ . '/a.png', ResponseHeaderBag::DISPOSITION_INLINE);
    }


    #[Route('/forecast/{threshold<\d+>}', methods: ['GET', 'POST'], name: "forecast")]
    public function forecast(
        Request $request,
        RequestStack $requestStack,
        ?int $threshold = null
    ): Response {

        $session = $requestStack->getSession();

        if ($threshold) {
            $session->set("threshold", $threshold);
            $this->addFlash('info', "This is flash message ::: ");
        } else {
            $threshold = $session->get("threshold", 50);
        }

        $forecasts = [];

        for ($x = 0; $x < $threshold; $x++) {
            $rint = random_int(0, 100);
            $forecasts[] = $rint < 50 ? "It's going to be cold" : "It's going to be warm";
        }

        return $this->render('weather/index.html.twig', [
            'forecasts' => $forecasts,
            'threshold' => $threshold
        ]);
    }


    #[Route('/forecast/{guess}', methods: ['GET', 'POST'], name: "forecast_guess")]
    public function forecast_weather(
        Request $request,
        RequestStack $requestStack,
        string $guess = null
    ): Response {
        $session = $requestStack->getSession();

        $threshold = $session->get("threshold");

        echo $threshold . "<br/>";

        $trials = $request->get('trials', default: 1);
        echo $trials;
        die();
        $weather_available = ['snow', 'sunny', 'rain', 'hail'];

        if (!in_array($guess, $weather_available)) {

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
    public function redirect_forecast(): RedirectResponse
    {

        return $this->redirectToRoute('forecast', [], 302);
    }
}
