<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-26
 * Time: 04:33 PM
 */

require_once ('../inclusion/inclusion.php');
AllIncludes("functions","dataB","validate","category","categoryS","categoryA","budgetIC");

if(isset($_POST)){
    $budgetID = $_POST["budgetId"];
    $time_line_id = $_POST["timelineID"];
    $projected_amount = $_POST["projectedA"];
    $actual_amount = $_POST["actualA"];
    $category = $_POST["category"];
    $category_id;

    $conn = con();
    $categoryObj = new Category($category);
    dataBaseManipulation(SQLInsert("category",$categoryObj),$conn,null,"insert in catergory",true);
    $category_id = (int) mysqli_insert_id($conn);
    $category_state = new CategoryState($time_line_id,$category_id);
    dataBaseManipulation(SQLInsert("category_state",$category_state),$conn,null,"inserting into category state",true);
    $budget_instance_category = new budgetInstanceCategory($category_id,$budgetID);
    dataBaseManipulation(SQLInsert("budget_instance_catagory",$budget_instance_category),$conn,null,"budget instance catagory",true);
    $category_amount = new CategoryAmount($actual_amount,$projected_amount,$category_id,$time_line_id);
    dataBaseManipulation(SQLInsert("category_amounts",$category_amount),$conn,null,"catergory amounts",true);



}
