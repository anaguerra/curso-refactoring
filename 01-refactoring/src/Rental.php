<?php

namespace Refactoring;

class Rental
{

    /**
     * @var Movie
     */
    private $_movie;

    /**
     * @var int
     */
    private $_daysRented;


    /**
     * Rental constructor.
     * @param Movie $movie
     * @param $daysRented
     */
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
    public function obtainFrequentRenterPoints()
    {
        return $this->getMovie()->obtainFrequentRenterPoints($this->_daysRented);
    }

}
