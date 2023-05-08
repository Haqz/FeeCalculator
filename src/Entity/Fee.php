<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
class Fee
{
    #[Assert\Choice([12, 24])]
    public $span;

    #[Assert\NotBlank]
    #[Assert\Range(
        min: 1000,
        max: 20000,
        notInRangeMessage: 'Your loan has to be between {{ min }} PLN and {{ max }} PLN',
    )]
    public $amount;
}