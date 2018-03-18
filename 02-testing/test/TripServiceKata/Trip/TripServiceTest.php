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




    /** @test
     * @expectedException TripServiceKata\Exception\UserNotLoggedInException
     */
    public function givenNotLoggedUserRetrieveException()
    {
        $this->tripService = new TripServiceWrapper();
        //given
        $this->tripService->loggedUserWrapper = null;
        //when
        $this->tripService->getTripsByUser(new User(null));
        $this->getExpectedException('TripServiceKata\Exception\UserNotLoggedInException');
        //then
        $this->assertTrue(true);
    }


    /**
     * @test
     */
    public function testUserAreNotFriendsThenObtainEmptyList()
    {
        $this->tripService = new TripServiceWrapper();
        // given
        $this->tripService->loggedUserWrapper = new User('Juan sinamigos');
        // when
        $tripList = $this->tripService->getTripsByUser(new User('Pepito'));
        //then
        $this->assertEquals([], $tripList);
    }


    /**
     * @test
     * Si el usuario es amigo del usuario logado devuelve lista de viajes
     */
    public function testUserLoggedIsFriendOfTripUserThenObtainATrip()
    {
        $this->tripService = new TripServiceWrapper();
        // given
        $juan = new User('Juan');
        $carlos = new User('Carlos');
        $juan->addFriend($carlos);

        $this->tripService->loggedUserWrapper = $carlos;

        // when
        $tripList = $this->tripService->getTripsByUser($juan);
        //then
        $this->assertNotEmpty($tripList);
    }


}





class TripServiceWrapper extends TripService
{
    public $loggedUserWrapper;


    protected function obtainLoggedUser()
    {
        return $this->loggedUserWrapper;
    }

    protected function obtainTripsByUser()
    {
        return [1, 2, 3];
    }


}