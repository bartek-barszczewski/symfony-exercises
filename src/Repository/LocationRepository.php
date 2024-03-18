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
}
