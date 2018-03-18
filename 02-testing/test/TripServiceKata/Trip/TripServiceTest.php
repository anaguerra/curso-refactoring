<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;

class TripServiceTest extends TestCase
{
    /**
     * @var TripService
     */
    private $tripService;

    /**
     *
     */
    protected function setUp()
    {
        $this->tripService = new TripServiceWrapper();
    }


    /** @test */
    public function givenNotLoggedUserRetrieveException()
    {
        try {
            $this->tripService->getTripsByUser(new User(null));
        } catch (UserNotLoggedInException $e) {
            $this->assertTrue(true);

        }
    }
}


class TripServiceWrapper extends TripService
{

    protected function obtainLoggedUser()
    {
        return null;
    }
}