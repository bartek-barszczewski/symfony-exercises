<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
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

    #[Route('/showById/{id}')]
    public function showById(LocationRepository $locationRepository, int $id = null ): JsonResponse {
        $location =  $locationRepository->find($id);

        return $this->json([
            "id" => $location->getId(),
            "name" => $location->getName(),
            "cc" => $location->getCountryCode(),
            "lat" => $location->getLatitude(),
            "long" => $location->getLongitude()
        ]);
    }

    #[Route('/showByCity/{city}')]
    public function showByCity(LocationRepository $locationRepository, string $city = null): JsonResponse {

        $location = $locationRepository->findOneBy([
            "name" => $city
        ]);

        return $this->json([
            "id" => $location->getId(),
            "name" => $location->getName(),
            "cc" => $location->getCountryCode(),
            "lat" => $location->getLatitude(),
            "long" => $location->getLongitude()
        ]);
    }

    #[Route('/showByCountryCode/{cc}')]
    public function showByCountryCode(LocationRepository $locationRepository, string $cc = null): JsonResponse {
        
        $locations = $locationRepository->findBy([
            "countryCode" => $cc,
        ]);

        $json = [];
        foreach( $locations as $location ) {
            $json[] = [
                "id" => $location->getId(),
                "name" => $location->getName(),
                "cc" => $location->getCountryCode(),
                "lat" => $location->getLatitude(),
                "long" => $location->getLongitude()
            ];
        }
        return $this->json($json);
    }

    #[Route('/showOneByName/{name}')]
    public function showOneByName(LocationRepository $locationRepository, string $name = null ): JsonResponse {

        $location = $locationRepository->findOneByName($name);

        if( !$location ) {
            throw $this->createNotFoundException();
        }

        return $this->json([
            "id" => $location->getId(),
            "name" => $location->getName(),
            "cc" => $location->getCountryCode(),
            "lat" => $location->getLatitude(),
            "long" => $location->getLongitude()
        ]);
    }

    #[Route('/location/show/{location_id}')]
    public function locationShow(
        #[MapEntity(mapping: [
            "location_id" => "id",
        ])]
        Location $location
    
        ): JsonResponse {
        
        return $this->json([
            "id" => $location->getId(),
            "name" => $location->getName(),
            "cc" => $location->getCountryCode(),
            "lat" => $location->getLatitude(),
            "long" => $location->getLongitude()
        ]);
    }

    
    #[Route('/location/showByName/{name}')]
    public function locationShowByNamme(
        Location $location
    ): JsonResponse {

        $json = [
            "id" => $location->getId(),
            "name" => $location->getName(),
            "cc" => $location->getCountryCode(),
            "lat" => $location->getLatitude(),
            "long" => $location->getLongitude()
        ];

        foreach($location->getForecasts() as $forecasts) {

            $json['forecasts'][ $forecasts->getDate()->format('Y-m-d') ] = [
                'celsius' => $forecasts->getCelsius(),
            ];
        }

        return $this->json($json);
    }

    #[Route('/')]
    public function findAllWithForecasts(
        LocationRepository $locationRepository
    ): JsonResponse {

        $locations =  $locationRepository->findAllWithForecasts();

        $json = [];

        foreach( $locations as $location ) {
            $locationJson  = [
                "id" => $location->getId(),
                "name" => $location->getName(),
                "cc" => $location->getCountryCode(),
                "lat" => $location->getLatitude(),
                "long" => $location->getLongitude()
            ];

            foreach( $location->getForecasts() as $forecasts ) {
                $locationJson['forecasts'][ $forecasts->getDate()->format('Y-m-d') ] = [
                    'celsius' => $forecasts->getCelsius(),
                ];
            }

            $json[] = $locationJson;
        }

        return $this->json(
           $json
        );
        // $json = [
        //     "id" => $location->getId(),
        //     "name" => $location->getName(),
        //     "cc" => $location->getCountryCode(),
        //     "lat" => $location->getLatitude(),
        //     "long" => $location->getLongitude()
        // ];

        // foreach($location->getForecasts() as $forecast) {

        //     $json['forecasts'][ $forecast->getDate()->format('Y-m-d') ] = [
        //         'celsius' => $forecast->getCelsius(),
        //     ];
        // }

        // return $this->json($json);
    }

    
}
