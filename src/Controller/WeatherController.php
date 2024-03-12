<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    #[Route('/forecast/{threshold<\d+>?50}', methods: ['GET', 'POST'] )]
    public function weather(int $threshold = 50): Response
    {
        $forecast = $threshold < 50 ? "It's going to be cold" : "It's going to be warm";

        return $this->render('weather/index.html.twig', [
            'forecast' => $forecast,
        ]);
    }

    #[Route('/forecast/{guess}', methods: ['GET', 'POST'])]
    public function weather_guess(string $guess): Response
    {

        $forecast = "It's going to be " . $guess;

        return $this->render('weather/index.html.twig', [
            'forecast' => $forecast,
        ]);
    }
}
