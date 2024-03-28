<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $countryName = null;
    
    #[ORM\Column(length: 5)]
    private ?string $cc = null;

    #[ORM\Column]
    private ?float $latitude = null;

    #[ORM\Column]
    private ?float $longitude = null;

    #[ORM\OneToMany(targetEntity: Forecast::class, mappedBy: 'location_id')]
    private Collection $forecasts;

    public function __construct()
    {
        $this->forecasts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): static
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getCc(): ?string
    {
        return $this->cc;
    }

    public function setCc(string $cc): static
    {
        $this->cc = $cc;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection<int, Forecast>
     */
    public function getForecasts(): Collection
    {
        return $this->forecasts;
    }

    public function addForecast(Forecast $forecast): static
    {
        if (!$this->forecasts->contains($forecast)) {
            $this->forecasts->add($forecast);
            $forecast->setLocationId($this);
        }

        return $this;
    }

    public function removeForecast(Forecast $forecast): static
    {
        if ($this->forecasts->removeElement($forecast)) {
            // set the owning side to null (unless already changed)
            if ($forecast->getLocationId() === $this) {
                $forecast->setLocationId(null);
            }
        }

        return $this;
    }
}
