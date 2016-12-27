<?php

/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-27
 * Time: 05:13 AM
 */
class CategoryAmount
{
    public $actual_amount = "";
    public $pojected_amount = "";
    public $catergory_id = 0;
    public $time_line_id = 0;

    public function __construct( $actual_amount , $pojected_amount , $catergory_id, $time_line_id)
    {
        $this->actual_amount = $actual_amount;
        $this->pojected_amount = $pojected_amount;
        $this->catergory_id = $catergory_id;
        $this ->time_line_id = $time_line_id;
    }

}