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
    $user_id = userID();
    $category_id;

    //find out if category exits even if it is removed

    $sql2 ="SELECT 
            c.category_id,
            c.name,
            CA.projected_amount,
            CA.actual_amount,
            BIC.budget_Instance_id,
            CS.time_line_id
        FROM `category_state` AS CS
            INNER JOIN category AS C
                ON C.category_id = CS.category_id
            INNER JOIN budget_instance_catagory AS BIC
                ON C.category_id = BIC.catagory_id
            INNER JOIN category_amounts AS CA
                ON c.category_id = CA.catergory_id
        WHERE BIC.budget_Instance_id =".$budgetID." 
        AND CS.state = 'active'
        AND ca.time_line_id=".$time_line_id."
        AND c.name ='".$category."'
        AND CS.time_line_id =".$time_line_id." ";
    $sql3 ="SELECT 
                c.category_id,
                c.name
            FROM budget_instance AS bi 
                INNER JOIN budget_instance_catagory AS bic 
                ON bi.budget_instance_id = bic.budget_Instance_id
                INNER JOIN user_budget_instance AS ubi
                ON ubi.budget_Instance_ID = bi.budget_instance_id
                INNER JOIN category AS c
                ON c.category_id = bic.catagory_id
            WHERE ubi.user_id = ".$user_id." 
                AND c.name = '".$category."'
                AND bi.budget_instance_id = ".$budgetID." ";
    $row = dataBaseManipulation($sql2,con(),"rows","get category name to see if is currenty active",false);
    $row2= dataBaseManipulation($sql3,con(),"rows","selecting from category to see if category exists",false);
   if($row2){

       if($row && strcmp(strtolower($row["name"]),strtolower($category))==0){
           //create report functionality

           printItemBreak("this item already exits in the budget");

       } else {
           printItemBreak("restoring old category");
           $new_category_id = $row2["category_id"];
           $category_state = new CategoryState($time_line_id, $new_category_id);
           dataBaseManipulation(SQLInsert("category_state", $category_state), con(), null, "inserting into category state", false);
           $budget_instance_category = new budgetInstanceCategory($new_category_id, $budgetID);
           dataBaseManipulation(SQLInsert("budget_instance_catagory", $budget_instance_category), con(), null, "budget instance catagory", false);
           $category_amount = new CategoryAmount($actual_amount, $projected_amount, $new_category_id, $time_line_id);
           dataBaseManipulation(SQLInsert("category_amounts", $category_amount), con(), null, "catergory amounts", false);
       }

   }else {
       printItemBreak("we failed");
       $conn = con();
       $categoryObj = new Category($category);
       dataBaseManipulation(SQLInsert("category", $categoryObj), $conn, null, "insert in catergory", false);
       $category_id = (int)mysqli_insert_id($conn);
       $category_state = new CategoryState($time_line_id, $category_id);
       dataBaseManipulation(SQLInsert("category_state", $category_state), $conn, null, "inserting into category state", false);
       $budget_instance_category = new budgetInstanceCategory($category_id, $budgetID);
       dataBaseManipulation(SQLInsert("budget_instance_catagory", $budget_instance_category), $conn, null, "budget instance catagory", false);
       $category_amount = new CategoryAmount($actual_amount, $projected_amount, $category_id, $time_line_id);
       dataBaseManipulation(SQLInsert("category_amounts", $category_amount), $conn, null, "catergory amounts", false);
   }

}
