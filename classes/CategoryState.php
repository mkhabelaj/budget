<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-27
 * Time: 05:09 AM
 */
class CategoryState
{
    public $state ="";
    public $time_line_id =0;
    public $category_id = 0;

    public function __construct($state,$time_line_id,$category_id)
    {
        $this->state = $state;
        $this->time_line_id = $time_line_id;
        $this->category_id =$category_id;
    }
}
