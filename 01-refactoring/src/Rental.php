<?php

namespace Refactoring;

class Rental
{
    private $_movie;
    private $_daysRented;

    public function __construct(Movie $movie, $daysRented)
    {
        $this->_movie = $movie;
        $this->_daysRented = $daysRented;
    }

    public function getDaysRented()
    {
        return $this->_daysRented;
    }

    public function getMovie()
    {
        return $this->_movie;
    }


    /**
     * @return float|int
     */
    public function obtainCharge()
    {
        return $this->getMovie()->obtainCharge($this->getDaysRented());
    }


    /**
     * @return int
     */
    public function calculateFrequentRenterPoints()
    {
        return 1 + $this->addBonusPoints();
    }


    /**
     * @return int
     */
    private function addBonusPoints()
    {
        $frequentRenterPoints = 0;

        if (($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE)
            && $this->getDaysRented() > 1) {

            $frequentRenterPoints = $frequentRenterPoints + 1;
        }
        return $frequentRenterPoints;
    }


}
