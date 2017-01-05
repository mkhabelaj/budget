<?php

/**
 * Created by PhpStorm.
 * User: jmkha
 * Date: 12/4/2016
 * Time: 8:49 PM
 */

require_once ("../interfaces/Include.php");
class Friend implements IncludeStatement
{
    public $own_user_id = 0;
    public $friend_user_id = 0;

    public function __construct($own_user_id, $friend_user_id)
    {
        $this->own_user_id = $own_user_id;
        $this->friend_user_id = $friend_user_id;
    }

    public function Inclusion()
    {
        require_once ("../classes/Friend.php");
    }
}