<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private function addLocation(
        string $name,
        string $cc,
        float $longitude,
        float $latitude
    ): Location
    {
        // $product = new Product();
        // $manager->persist($product);
        // php bin/console doctrine:fixtures:load --append
        // php bin/console doctrine:fixtures:load
        $location = new Location();

        $location
            ->setName($name)
            ->setCountryCode($cc)
            ->setLatitude($latitude)
            ->setLongitude($longitude)
        ;
        //$manager->flush();
        return $location;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
                
        $manager->persist( $this->addLocation("Cracow", "PL", 12.3123, 55.2311) );
        $manager->persist( $this->addLocation("Moscow", "RU", 22.3123, 5.2311) );
        $manager->persist( $this->addLocation("Tokio", "JP", 52.3123, 66.6311) );
        $manager->persist( $this->addLocation("New York", "US", 42.3123, 7.2311) );
        $manager->persist( $this->addLocation("Brasil", "BR", 2.3123, 8.2311) );
        
         $manager->flush();
    }
}
