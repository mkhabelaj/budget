<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-27
 * Time: 05:09 AM
 */
require_once ("../interfaces/Include.php");
class CategoryState implements IncludeStatement
{
    public $time_line_id =0;
    public $category_id = 0;

    public function __construct($time_line_id,$category_id)
    {
        $this->time_line_id = $time_line_id;
        $this->category_id =$category_id;
    }

    public function Inclusion()
    {
        require_once ("../classes/CategoryState.php");
    }
}
