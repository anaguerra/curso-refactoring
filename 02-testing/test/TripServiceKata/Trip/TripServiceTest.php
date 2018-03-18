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
        $this->tripService->loggedUserWrapper = new User('Juan sinamigos');

        // when
        $tripList = $this->tripService->getTripsByUser(new User('Pepito'));

        //then
        $this->assertEquals([], $tripList);
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