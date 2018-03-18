<?php

namespace TripServiceKata\Trip;

use TripServiceKata\User\User;
use TripServiceKata\User\UserSession;
use TripServiceKata\Exception\UserNotLoggedInException;

class TripService
{
    public function getTripsByUser(User $user)
    {
        $tripList = array();
        $loggedUser = $this->obtainLoggedUser();

        $this->checkIfUserIsLogged($loggedUser);

        $isFriend = $this->areFriends($user, $loggedUser);
        if ($isFriend) {
            $tripList = $this->obtainTripsByUser($user);
        }
        return $tripList;
    }


    private function checkIfUserIsLogged($loggedUser)
    {
        if (is_null($loggedUser)) {
            throw new UserNotLoggedInException();
        }
    }



    protected function obtainLoggedUser()
    {
        return UserSession::getInstance()->getLoggedUser();
    }


    protected function obtainTripsByUser($user)
    {
        return TripDAO::findTripsByUser($user);
    }


    /**
     * @param User $user
     * @param $loggedUser
     * @return bool
     */
    private function areFriends(User $user, $loggedUser): bool
    {
        $isFriend = false;

        foreach ($user->getFriends() as $friend) {
            if ($friend == $loggedUser) {
                $isFriend = true;
                break;
            }
        }
        return $isFriend;
    }
}

