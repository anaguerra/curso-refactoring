<?php

namespace Test\TripServiceKata\Trip;

use PHPUnit\Framework\TestCase;
use TripServiceKata\Exception\UserNotLoggedInException;
use TripServiceKata\Trip\TripService;
use TripServiceKata\User\User;

class TripServiceTest extends TestCase
{

    private $userLogged;
    private $withoutFriends;
    private $antonioFriend;


    protected function setUp()
    {
        parent::setUp();
        $this->userLogged = new User('Antonio con login');
        $this->withoutFriends = new User('sin amigos');
        $this->antonioFriend = new User('carlos el amigo de Antonio');
        $this->antonioFriend->addFriend($this->userLogged);
    }



    /** @test
     * @expectedException TripServiceKata\Exception\UserNotLoggedInException
     */
    public function givenNotLoggedUserRetrieveException()
    {
        //given
        $tripService = new TripServiceWrapper(null);
        //when
        $tripService->getTripsByUser(new User('aaa'));
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
        $tripService = new TripServiceWrapper($this->userLogged);
        // when
        $tripList = $tripService->getTripsByUser($this->withoutFriends);
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
        $tripService = new TripServiceWrapper($this->userLogged);
        // when
        $tripList = $tripService->getTripsByUser($this->antonioFriend);
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