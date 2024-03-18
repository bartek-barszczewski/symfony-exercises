<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/location-dummy")]
class LocationDummyController extends AbstractController
{
    #[Route('/create')]
    public function index(LocationRepository $locationRepository): JsonResponse
    {
        $location = new Location();
        $location
            ->setName("Gdansk")
            ->setCountryCode("PL")
            ->setLongitude(1.31222)
            ->setLatitude(53.22312)
        ;

        $locationRepository->save($location, true);

        return $this->json([
            "id" =>  $location->getId()
        ]);
    }

    #[Route('/edit')]
    public function edit(LocationRepository $locationRepository): JsonResponse {
        $location = $locationRepository->find(3);
        $location->setName("Paris");

        $locationRepository->save($location, true);
        
        return $this->json([
            "id" => $location->getId(),
            "name" => $location->getName(),
        ]);
    }

    #[Route('/remove/{id<\d+>}')]
    public function remove(LocationRepository $locationRepository, int $id = null): JsonResponse {
        // dump($id);
        $location = new Location();
        $location = $locationRepository->find($id);
        
        $locationRepository->remove($location, true);
                
        // dump($location);
        // die();

        return $this->json([
            "delete" => "ok",
            "id" => $id
        ]);
    }
}
