<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-30
 * Time: 08:18 AM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB");
require_once ("../classes/Category.php");
require_once ("../classes/CategoryAmount.php");
require_once ("../classes/budgetInstanceCategory.php");

if(isset($_POST)){
    $category_id = (int)$_POST["categoryID"];
    $budget_id = (int)$_POST["budgetID"];
    $time_line_id =(int) $_POST["timelineID"];
    $projected_amount = (int)$_POST["projectedAmount"];
    $actual_amount = (int)$_POST["actualAmount"];
    $category_new = $_POST["category"];

    $sql = "SELECT 
                c.category_id,
                ca.actual_amount,
                ca.projected_amount,
                bic.budget_Instance_id,
                COUNT(*) as total
            FROM category AS c
                INNER JOIN category_amounts AS ca
                ON c.category_id = ca.catergory_id
                INNER JOIN budget_instance_catagory AS bic
                ON bic.catagory_id = c.category_id
            WHERE c.category_id IN(".$category_id.") AND bic.budget_Instance_id IN(".$budget_id.")";

  if(dataBaseManipulation($sql,con(),"rows","count category relations",false)["total"] > 1){
        //change
      $new_category = new Category($category_new);
      $category_id = mysqli_insert_id(dataBaseManipulation(SQLInsert("category",$new_category),con(),"conn","Insert new Category",true));
      $categoryAmount = new CategoryAmount($actual_amount,$projected_amount,$category_id,$time_line_id);
      dataBaseManipulation(SQLInsert("category_amount",$catagoryAmount),con(),"result","insert new value to category amounts",true);
    }else{
      $catagory = new Category($category_new);
      $catagoryAmount = new CategoryAmount($actual_amount,$projected_amount,$category_id,$time_line_id);
      unsetProperties($catagoryAmount,"catergory_id","time_line_id");
      printItemBreak(createQueryStringForUpdate($catagoryAmount));
      dataBaseManipulation(SQLUpdate("category",$catagory,"category_id",$category_id),con(),"result","update category",true);
      dataBaseManipulation(SQLUpdate("category_amounts",$catagoryAmount,"catergory_id",$category_id),con(),"result","update category amount",true);
  }

}