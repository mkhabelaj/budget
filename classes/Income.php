<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-28
 * Time: 03:59 PM
 */
require_once ("../interfaces/Include.php");
class Income implements IncludeStatement
{
    public $income = 0;
    public $budget_instance_id = 0;
    public $time_line_id = 0;

    public function __construct($income, $budget_instance_id,$time_line_id)
    {
        $this->income =$income;
        $this->budget_instance_id =$budget_instance_id;
        $this->time_line_id = $time_line_id;

    }

    public function Inclusion()
    {
        require_once ("../classes/Income.php");
    }
}