<?php

namespace Refactoring\Price;


use Refactoring\Movie;

class NewRelease extends Price
{


    public function getPriceCode()
    {
        return Movie::NEW_RELEASE;
    }

    public function obtainCharge($daysRented)
    {
        return $daysRented * 3;
    }


    public function obtainFrequentRenterPoints($daysRented)
    {
        return ($daysRented > 1) ? 2 : 1;
    }
}