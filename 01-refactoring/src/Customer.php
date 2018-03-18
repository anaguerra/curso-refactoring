<?php

namespace Refactoring;

class Customer
{
    private $_name;
    private $_rentals = array();

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function addRental(Rental $arg)
    {
        $this->_rentals[] = $arg;
    }

    public function getName()
    {
        return $this->_name;
    }


    public function statement()
    {

        $result = 'Rental Record for ' . $this->getName() . "\n";

        foreach ($this->_rentals as $rental) {

            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $rental->obtainCharge() . "\n";
        }

        $result .= 'Amount owed is ' . $this->obtainTotalAmount($this->_rentals) . "\n";
        $result .= 'You earned ' . $this->obtainTotalFrequentPoints($this->_rentals) . ' frequent renter points';

        return $result;
    }


    /**
     * @param $rentals
     * @return int
     */
    private function obtainTotalAmount($rentals)
    {
        $totalAmount = 0;

        foreach ($rentals as $rental) {
            $totalAmount = $totalAmount + $rental->obtainCharge();
        }

        return $totalAmount;
    }


    /**
     * @param $rentals
     */
    private function obtainTotalFrequentPoints($rentals)
    {
        $frequentRenterPoints = 0;

        foreach ($rentals as $rental) {
            // add frequent renter points
            $frequentRenterPoints = $frequentRenterPoints + $rental->obtainFrequentRenterPoints();
        }
        return $frequentRenterPoints;
    }
}



