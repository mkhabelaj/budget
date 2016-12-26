<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-26
 * Time: 04:33 PM
 */

require_once ('../inclusion/inclusion.php');
factory()->getInclusion('functions')->Inclusion();
factory()->getInclusion('dataB')->Inclusion();

if(isset($_POST)){
    $budgetID = $_POST["budgetId"];
    $time_line_id = $_POST["timelineID"];
    $projected_amount = $_POST["projectedA"];
    $actual_amount = $_POST["actualA"];
    $category = $_POST["category"];
    printItem($budgetID);
    createBreak();
    printItem($time_line_id);
    createBreak();
    printItem($category);
    createBreak();
    printItem($actual_amount);
    createBreak();
    printItem($projected_amount);
    createBreak();

    $conn = con();
    $sql="";
}
