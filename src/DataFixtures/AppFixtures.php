<?php

namespace App\DataFixtures;

use App\Entity\Forecast;
use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    private function addLocation(
        string $city,
        string $countryName,
        string $cc,
        float $latitude,
        float $longitude
    ): Location {
    
        $location = new Location();
        $location
            ->setCity($city)
            ->setCountryName($countryName)
            ->setCc($cc)
            ->setLatitude($latitude)
            ->setLongitude($longitude)
        ;

        return $location;
    }

    private function addForecast(
        float $temperature,
        float $pressure,
        float $wind_speed,
        bool $cloud,
        bool $sun,
        bool $rain,
        bool $snow,
        \DateTime $date,
        Location $location,
    ): Forecast {
        $forecast = new Forecast();
        
        $forecast   
            ->setTemperature($temperature)
            ->setPressure($pressure)
            ->setWindSpeed($wind_speed)
            ->setCloud($cloud)
            ->setSun($sun)
            ->setRain($rain)
            ->setSnow($snow)
            ->setDate($date)
            ->setLocationId($location)
        ;

        return $forecast;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);


        $location = $this->addLocation('Berlin', 'Germany', 'GE', 52.520008, 13.404954);

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-28 12:00:00');
        $manager->persist( $this->addForecast(12.4, 1012, 33.1, true, false, false, false, $date,  $location ) );

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-29 12:00:00');
        $manager->persist( $this->addForecast(12.4, 1012, 33.1, true, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-30 12:00:00');
        $manager->persist( $this->addForecast(5.5, 1010, 33.1, false, false, false, false, $date,  $location ) );

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-31 12:00:00');        
        $manager->persist( $this->addForecast(5.4, 1002, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-01 12:00:00');
        $manager->persist( $this->addForecast(-12.4, 1004, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-02 12:00:00');
        $manager->persist( $this->addForecast(-2.4, 1014, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-03 12:00:00');
        $manager->persist( $this->addForecast(-12, 1005, 33.1, false, false, false, false, $date,  $location ) );
        
        
        $location = $this->addLocation('Kabul', 'Afghanistan', 'AF', 34.543896, 69.160652);


        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-28 12:00:00');
        $manager->persist( $this->addForecast(8.4, 1012, 33.1, false, true, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-29 12:00:00');
        $manager->persist( $this->addForecast(6.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-30 12:00:00');
        $manager->persist( $this->addForecast(7.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-31 12:00:00');
        $manager->persist( $this->addForecast(2.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-01 12:00:00');
        $manager->persist( $this->addForecast(3.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-02 12:00:00');
        $manager->persist( $this->addForecast(3.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-03 12:00:00');
        $manager->persist( $this->addForecast(3.4, 1012, 33.1, false, false, false, false, $date,  $location ) );

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-04 12:00:00');
        $manager->persist( $this->addForecast(3.4, 1012, 33.1, false, false, false, false, $date,  $location ) );


        $location = $this->addLocation('Beijing', 'China', 'CHI', 39.916668, 116.383331);


        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-28 12:00:00');
        $manager->persist( $this->addForecast(4.4, 1012, 33.1, false, true, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-29 12:00:00');
        $manager->persist( $this->addForecast(4.3, 1012, 33.1, false, false, false, false, $date,  $location ) );
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-30 12:00:00');
        
        $manager->persist( $this->addForecast(1.7, 1012, 33.1, false, false, false, false, $date,  $location ) );
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-03-31 12:00:00');
        
        $manager->persist( $this->addForecast(11.7, 1012, 33.1, false, false, false, false, $date,  $location ) );
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-01 12:00:00');
        
        $manager->persist( $this->addForecast(12.8, 1012, 33.1, false, false, false, false, $date,  $location ) );
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-02 12:00:00');
        
        $location = $this->addLocation('Shanghai', 'China', 'CHI', 31.224361, 121.469170);
        $manager->persist( $this->addForecast(8.4, 1012, 33.1, false, false, false, true, $date,  $location ) );
       
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-02 12:00:00');
        $manager->persist( $this->addForecast(2.8, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-03 12:00:00');
        $manager->persist( $this->addForecast(9.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', '2023-04-04 12:00:00');
        $manager->persist( $this->addForecast(10.4, 1012, 33.1, false, false, false, false, $date,  $location ) );
        
        $manager->flush();
    }
}
