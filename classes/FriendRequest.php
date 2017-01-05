<?php

/**
 * Created by PhpStorm.
 * User: jmkha
 * Date: 12/4/2016
 * Time: 8:07 AM
 */
require_once ("../interfaces/Include.php");
class FriendRequest implements IncludeStatement
{
    public $requester = 0;
    public $requestee = 0;

    public function __construct( $requester, $requestee)
    {
        $this->requester = $requester;
        $this->requestee = $requestee;
    }

    public function Inclusion()
    {
        require_once ("../classes/FriendRequest.php");
    }
}