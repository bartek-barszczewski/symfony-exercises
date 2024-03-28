<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    public function getAll(): ?array {
        
        $query = $this->createQueryBuilder("l");

        $query 
            ->select('l')
        ;

        $query = $query->getQuery();
        $result = $query->getResult();

        return $result;
    }
    
    public function findOneByName($city, $date): ?Location {
        dump($city);
        dump($date);

        $query = $this->createQueryBuilder("l");

        $query
            ->select("l", "f")
            ->leftJoin("l.forecasts", "f")
            ->where("f.date = :date")
            ->setParameter("date", "" )
        ;

        $query = $query->getQuery();
        dump($query);

        //die();
        $result = $query->getResult();
        dump($result);
        die();

        return $result;
    }
}
