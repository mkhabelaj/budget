<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-12
 * Time: 12:14 PM
 */

require_once ("../interfaces/Include.php");
class Preference implements IncludeStatement
{

    public $currency_id = 0;
    public $user_id = 0;

    public function __construct($currency_id,$user_id)
    {
        $this->currency_id = $currency_id;
        $this->user_id = $user_id;
    }

    public function Inclusion()
    {
        require_once ("../classes/Preference.php");
    }
}