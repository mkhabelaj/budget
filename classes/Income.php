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
    public $description ="";
    public $budget_instance_id = 0;
    public $time_line_id = 0;
    public $user_id = 0;

    public function __construct($income, $budget_instance_id,$time_line_id,$description,$user_id)
    {
        $this->income =$income;
        $this->budget_instance_id =$budget_instance_id;
        $this->time_line_id = $time_line_id;
        $this->description = $description;
        $this->user_id = $user_id;
    }

    public function Inclusion()
    {
        require_once ("../classes/Income.php");
    }
}