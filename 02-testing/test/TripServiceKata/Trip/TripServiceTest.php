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


    /** @test
     * @expectedException TripServiceKata\Exception\UserNotLoggedInException
     */
    public function givenNotLoggedUserRetrieveException()
    {
        //given
        $this->tripService->loggedUserWrapper = null;
        $this->getExpectedException('TripServiceKata\Exception\UserNotLoggedInException');

        //when
        $this->tripService->getTripsByUser(new User(null));

        //then
        $this->assertTrue(true);

    }
}


class TripServiceWrapper extends TripService
{
    public $loggedUserWrapper;


    protected function obtainLoggedUser()
    {
        return $this->loggedUserWrapper;
    }
}