<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-30
 * Time: 08:18 AM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","category","categoryA","budgetIC","categoryS");

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
        WHERE BIC.budget_Instance_id =".$budget_id." 
        AND CS.state = 'active'
        AND ca.time_line_id=".$time_line_id."
        AND c.name ='".$category_new."'
        AND CS.time_line_id =".$time_line_id." ";
      if($result = dataBaseManipulation($sql2,con(),"rows","get category name",true)){
          var_dump($result);
          printItemBreak("hi");
          $catagory = new Category($category_new);
          $catagoryAmount = new CategoryAmount($actual_amount,$projected_amount,$category_id,$time_line_id);
          unsetProperties($catagoryAmount,"catergory_id","time_line_id");
          printItemBreak(createQueryStringForUpdate($catagoryAmount));
          dataBaseManipulation(SQLUpdate("category",$catagory,"category_id",$category_id),con(),"result","update category",true);
          dataBaseManipulation(SQLUpdate("category_amounts",$catagoryAmount,"catergory_id",$category_id," AND time_line_id =",$time_line_id),con(),"result","update category amount",true);

      }else{
          printItemBreak("testing second internal else");
          $sql3 ="UPDATE category_state SET `state`='removed' WHERE time_line_id=".$time_line_id." AND category_id=".$category_id;
          dataBaseManipulation($sql3,con(),"result","deactivate category state",true);

          $sql4="DELETE FROM category_amounts WHERE catergory_id=".$category_id." AND time_line_id=".$time_line_id;
          dataBaseManipulation($sql4,con(),"result","deleteing from categoty amount",true);

          $new_category = new Category($category_new);
          $category_id = mysqli_insert_id(dataBaseManipulation(SQLInsert("category",$new_category),con(),"conn","Insert new Category",true));
          $bic = new budgetInstanceCategory($category_id,$budget_id);
          dataBaseManipulation(SQLInsert("budget_instance_catagory",$bic),con(),"conn","insert into budget instance category",true);
          $categoryAmount = new CategoryAmount($actual_amount,$projected_amount,$category_id,$time_line_id);
          dataBaseManipulation(SQLInsert("category_amounts",$categoryAmount),con(),"result","insert new value to category amounts",true);
          $category_state = new CategoryState($time_line_id,$category_id);
          dataBaseManipulation(SQLInsert("category_State",$category_state),con(),"result","inserting into category state",true);

      }

    }else{
      $catagory = new Category($category_new);
      $catagoryAmount = new CategoryAmount($actual_amount,$projected_amount,$category_id,$time_line_id);
      unsetProperties($catagoryAmount,"catergory_id","time_line_id");
      printItemBreak(createQueryStringForUpdate($catagoryAmount));
      dataBaseManipulation(SQLUpdate("category",$catagory,"category_id",$category_id),con(),"result","update category",true);
      dataBaseManipulation(SQLUpdate("category_amounts",$catagoryAmount,"catergory_id",$category_id," AND time_line_id =",$time_line_id),con(),"result","update category amount",true);
  }

}