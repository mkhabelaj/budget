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
require_once ("../classes/Category.php");
require_once ("../classes/CategoryState.php");
require_once ("../classes/CategoryAmount.php");
require_once ("../classes/budgetInstanceCategory.php");

if(isset($_POST)){
    $budgetID = $_POST["budgetId"];
    $time_line_id = $_POST["timelineID"];
    $projected_amount = $_POST["projectedA"];
    $actual_amount = $_POST["actualA"];
    $category = $_POST["category"];
    $category_id;
//    printItem($budgetID);
//    createBreak();
//    printItem($time_line_id);
//    createBreak();
//    printItem($category);
//    createBreak();
//    printItem($actual_amount);
//    createBreak();
//    printItem($projected_amount);
//    createBreak();

    $conn = con();
    $categoryObj = new Category($category);
    dataBaseManipulation(SQLInsert("category",$categoryObj),$conn,null,"insert in catergory",true);
    $category_id = (int) mysqli_insert_id($conn);
    $category_state = new CategoryState($time_line_id,)
    dataBaseManipulation(SQLInsert(""))
    printItemBreak($s);


}
