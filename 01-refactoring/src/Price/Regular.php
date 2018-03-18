<?php

namespace Refactoring\Price;


use Refactoring\Movie;

class Regular extends Price
{


    public function getPriceCode()
    {
        return Movie::REGULAR;
    }



    public function obtainCharge($daysRented)
    {
        $amount = 2;
        if ($daysRented > 2) {
            $amount = $amount + ($daysRented - 2) * 1.5;
        }

        return $amount;
    }

}