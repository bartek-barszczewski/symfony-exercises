<?php

namespace App\Model;
use Symfony\Component\Validator\Constraints as Assert;

class ForecastModelDTO {
    public function __construct(
        #[Assert\NotBlank]
        public int $threshold = 50,

        #[Assert\NotBlank]
        public int $trials = 1,

        #[Assert\NotBlank]
        #[Assert\Email(
            message: 'The email {{ value }} is not a valid email'
        )]
        public string $email = "",
    ){
    }
}