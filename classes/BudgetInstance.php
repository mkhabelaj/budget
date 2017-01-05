<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-28
 * Time: 03:55 PM
 */
require_once ("../interfaces/Include.php");
class BudgetInstance implements IncludeStatement
{
    public $name ="";

    public function Inclusion()
    {
        require_once ("../classes/BudgetInstance.php");
    }

    public function __construct($name)
    {
        $this->name = $name;
    }

}