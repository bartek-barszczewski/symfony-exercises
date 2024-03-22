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

    public function save(Location $entity, bool $flush = false): void {
        $em = $this->getEntityManager();
        $em->persist($entity);

        if($flush) {
            $em->flush();
        }
    }

    public function remove(Location $entity, bool $flush = false): void {
        $em = $this->getEntityManager();
        // dump($entity);
        // die();
        $em->remove($entity);

        if($flush) {
            $em->flush();
        }
    }

    public function findOneByName(string $name): ?Location {

        $qb = $this->createQueryBuilder("l");
        $qb
            ->where('l.name = :name')
            ->setParameter('name', $name)
            ->andWhere('l.countryCode = :countryCode')
            ->setParameter( 'countryCode', 'PL' )
        ;

        $query = $qb->getQuery();

        $entity = $query->getOneOrNullResult();

        return $entity;
        
    }

    public function findAllWithForecasts(): array {
        $qb = $this->createQueryBuilder('l');

        $qb
            ->select('l', 'f')
            ->leftJoin('l.forecasts', 'f')
        ;

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }

}
