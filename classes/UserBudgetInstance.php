<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-29
 * Time: 03:55 PM
 */
class UserBudgetInstance
{
    public $budget_instance_ID = 0;
    public $user_id = 0;

    public function __construct($budget_instance_ID,$user_id)
    {
        $this->budget_instance_ID =$budget_instance_ID;
        $this->user_id = $user_id;
    }

}