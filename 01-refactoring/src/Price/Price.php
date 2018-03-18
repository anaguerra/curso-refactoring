<?php

namespace Refactoring\Price;


abstract class Price
{

    public abstract function getPriceCode();


    /**
     * @param $daysRented
     * @return float|int
     */
    public abstract function obtainCharge($daysRented);


}