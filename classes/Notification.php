<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-12
 * Time: 03:34 PM
 */
require_once ("../interfaces/Include.php");
class Notification implements IncludeStatement
{
    public  $message ="";
    public $user_id =0;

    public function __construct($message,$user_id)
    {
        $this->message = $message;
        $this->user_id = $user_id;
    }

    public function Inclusion()
    {
        require_once ("../classes/Notification.php");
    }
}