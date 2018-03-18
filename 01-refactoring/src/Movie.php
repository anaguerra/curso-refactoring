<?php

namespace Refactoring;

use Refactoring\Price\Children;
use Refactoring\Price\NewRelease;
use Refactoring\Price\Price;
use Refactoring\Price\Regular;

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    /**
     * @var string
     */
    private $_title;

    /** @var Price */
    private $_price;


    /**
     * Movie constructor.
     * @param $title
     * @param $priceCode
     */
    public function __construct($title, $priceCode)
    {
        $this->_title = $title;
        $this->setPrice($priceCode);
    }


    public function getPriceCode()
    {
        return $this->_price->getPriceCode();
    }


    public function getTitle()
    {
        return $this->_title;
    }


    /**
     * @param $daysRented
     * @return float|int
     */
    public function obtainCharge($daysRented)
    {
        return $this->_price->obtainCharge($daysRented);
    }


    /**
     * @return int
     */
    public function obtainFrequentRenterPoints($daysRented)
    {
        return $this->_price->obtainFrequentRenterPoints($daysRented);
    }




    /**
     * @param $priceCode
     */
    private function setPrice($priceCode)
    {
        switch ($priceCode) {

            case self::REGULAR:
                $this->_price = new Regular();
                break;
            case self::NEW_RELEASE:
                $this->_price = new NewRelease();
                break;
            case self::CHILDRENS:
                $this->_price = new Children();
                break;
        }
    }
}
