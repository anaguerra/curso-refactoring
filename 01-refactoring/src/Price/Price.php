<?php

namespace Refactoring\Price;



abstract class Price
{

    public abstract function getPriceCode();


    /**
     * @param $daysRented
     */
    public abstract function obtainCharge($daysRented);


    /**
     * @param $daysRented
     * @return int
     */
    public function obtainFrequentRenterPoints($daysRented)
    {
        return 1;
    }

}