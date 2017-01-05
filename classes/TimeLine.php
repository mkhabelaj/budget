<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-28
 * Time: 04:01 PM
 */

require_once ("../interfaces/Include.php");
class TimeLine  implements IncludeStatement
{
    public $duration_start = "";
    public $duration_end = "";
    public $frequency = "";
    public $budget_instance_ID = 0;
    public $reset_day = 0;

    public function __construct($duration_start,$duration_end,$frequency,$budget_instance_ID)
    {
        $this->duration_start = $duration_start;
        $this->duration_end = $duration_end;
        $this->frequency = $frequency;
        $this->budget_instance_ID = $budget_instance_ID;
    }

    public function Inclusion()
    {
        require_once ("../classes/TimeLine.php");
    }
}