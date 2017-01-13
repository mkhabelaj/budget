<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-13
 * Time: 06:03 PM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","income");

if(isset($_POST)){
    $time_line_id = $_POST["timeLineId"];
    $budget_id = $_POST["budgetId"];
    $description = $_POST["description"];
    $income = $_POST["income"];

    printItemBreakMany($time_line_id,$budget_id,$income,$description);
    $incomeObj = new Income($income,$budget_id,$time_line_id,$description,userID());
    dataBaseManipulation(SQLInsert("income",$incomeObj),con(),"result","inserting into incom",true);
}