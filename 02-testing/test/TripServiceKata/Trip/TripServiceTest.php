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
        //given
        $this->tripService = new TripServiceWrapper(null);
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
        // given
        $this->tripService = new TripServiceWrapper(new User('Juan sinamigos'));
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
        // given
        $carlos = new User('Carlos');
        $this->tripService = new TripServiceWrapper($carlos);
        $juan = new User('Juan');
        $juan->addFriend($carlos);

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

    protected function obtainTripsByUser($user)
    {
        return [1, 2, 3];
    }


}