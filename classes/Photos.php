<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-20
 * Time: 01:29 PM
 */
require_once ("../interfaces/Include.php");
class Photos implements IncludeStatement
{
    public $url = "";
    public $user_id = 0;
    public $status = "";

    public function __construct($url,$user_id,$status)
    {
        $this->url = $url;
        $this->user_id = $user_id;
        $this->status = $status;
    }

    public function Inclusion()
    {
        require_once ("../classes/Photos.php");
    }
}