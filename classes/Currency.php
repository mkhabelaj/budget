<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-12
 * Time: 12:04 PM
 */
require_once ("../interfaces/Include.php");
class Currency implements IncludeStatement
{

    public $country ="";
    public $codes = "";

    public function __construct($country,$codes)
    {
        $this->country = $country;
        $this->codes = $codes;
    }

    public function Inclusion()
    {
        require_once ("../classes/Currency.php");
    }
}