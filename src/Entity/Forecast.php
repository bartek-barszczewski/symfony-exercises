<?php

namespace App\Entity;

use App\Repository\ForecastRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ForecastRepository::class)]
class Forecast
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $temperature = null;

    #[ORM\Column]
    private ?float $pressure = null;

    #[ORM\Column]
    private ?float $wind_speed = null;

    #[ORM\Column]
    private ?bool $cloud = null;

    #[ORM\Column]
    private ?bool $sun = null;

    #[ORM\Column]
    private ?bool $rain = null;

    #[ORM\Column]
    private ?bool $snow = null;

    #[ORM\Column]
    private ?\DateTime $date = null;

    #[ORM\ManyToOne(targetEntity: Location::class, inversedBy: 'forecasts', cascade:['persist'] )]
    #[ORM\JoinColumn(nullable: false)]
    private ?Location $location_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): static
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPressure(): ?float
    {
        return $this->pressure;
    }

    public function setPressure(float $pressure): static
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getWindSpeed(): ?float
    {
        return $this->wind_speed;
    }

    public function setWindSpeed(float $wind_speed): static
    {
        $this->wind_speed = $wind_speed;

        return $this;
    }

    public function isCloud(): ?bool
    {
        return $this->cloud;
    }

    public function setCloud(bool $cloud): static
    {
        $this->cloud = $cloud;

        return $this;
    }

    public function isSun(): ?bool
    {
        return $this->sun;
    }

    public function setSun(bool $sun): static
    {
        $this->sun = $sun;

        return $this;
    }

    public function isRain(): ?bool
    {
        return $this->rain;
    }

    public function setRain(bool $rain): static
    {
        $this->rain = $rain;

        return $this;
    }

    public function isSnow(): ?bool
    {
        return $this->snow;
    }

    public function setSnow(bool $snow): static
    {
        $this->snow = $snow;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getLocationId(): ?Location
    {
        return $this->location_id;
    }

    public function setLocationId(?Location $location_id): static
    {
        $this->location_id = $location_id;

        return $this;
    }
}
