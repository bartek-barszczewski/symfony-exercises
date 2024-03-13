<?php

namespace App\RequestModel;

class WeatherForecastDTO
{
    public function __construct(
        public string $countryCode = "",
        public string $city = "",
    ) {
    }
}
