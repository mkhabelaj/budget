<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-27
 * Time: 05:20 AM
 */
require_once ("../interfaces/Include.php");
class budgetInstanceCategory implements IncludeStatement
{
    public $catagory_id = 0;
    public $budget_instance_id = 0;

    public function __construct($catagory_id,$budget_instance_id)
    {
        $this->catagory_id = $catagory_id;
        $this->budget_instance_id = $budget_instance_id;
    }

    public function Inclusion()
    {
        require_once ("../classes/budgetInstanceCategory.php");
    }
}