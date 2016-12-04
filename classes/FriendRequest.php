<?php

/**
 * Created by PhpStorm.
 * User: jmkha
 * Date: 12/4/2016
 * Time: 8:07 AM
 */
class FriendRequest
{
    public $requester = 0;
    public $requestee = 0;

    public function __construct( $requester, $requestee)
    {
        $this->requester = $requester;
        $this->requestee = $requestee;
    }

}