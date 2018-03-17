<?php

namespace Refactoring;

class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    private $_title;
    private $_priceCode;

    public function __construct($title, $priceCode)
    {
        $this->_title = $title;
        $this->_priceCode = $priceCode;
    }

    public function getPriceCode()
    {
        return $this->_priceCode;
    }

    public function setPriceCode($arg)
    {
        $this->_priceCode = $arg;
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
        $thisAmount = 0;

        switch ($this->getPriceCode()) {
            case Movie::REGULAR:
                $thisAmount += 2;
                if ($daysRented > 2) {
                    $thisAmount += ($daysRented - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $thisAmount += $daysRented * 3;
                break;
            case Movie::CHILDRENS:
                $thisAmount += 1.5;
                if ($daysRented > 3) {
                    $thisAmount += ($daysRented - 3) * 1.5;
                }
                break;

        }


        return $thisAmount;
    }


    /**
     * @return int
     */
    public function calculateFrequentRenterPoints($daysRented)
    {
        return 1 + $this->addBonusPoints($daysRented);
    }


    /**
     * @return int
     */
    private function addBonusPoints($daysRented)
    {
        $frequentRenterPoints = 0;

        if (($this->getPriceCode() == Movie::NEW_RELEASE)
            && $daysRented > 1) {

            $frequentRenterPoints = $frequentRenterPoints + 1;
        }
        return $frequentRenterPoints;
    }

}
