<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-26
 * Time: 06:05 PM
 */

require_once ("../interfaces/Include.php");
class Category implements IncludeStatement
{
    public $name = "";

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function Inclusion()
    {
        require_once ("../classes/Category.php");
    }
}