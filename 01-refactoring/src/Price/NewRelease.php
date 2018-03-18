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
        $frequentRenterPoints = 1;

        if (($this->getPriceCode() == Movie::NEW_RELEASE)
            && $daysRented > 1) {

            $frequentRenterPoints = $frequentRenterPoints + 1;
        }
        return $frequentRenterPoints;
    }
}