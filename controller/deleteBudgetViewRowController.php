<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-10
 * Time: 10:33 AM
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
            printItemBreak("testing second internal else");
            $sql3 ="UPDATE category_state SET `state`='removed' WHERE time_line_id=".$time_line_id." AND category_id=".$category_id;
            dataBaseManipulation($sql3,con(),"result","deactivate category state",true);

            $sql4="DELETE FROM category_amounts WHERE catergory_id=".$category_id." AND time_line_id=".$time_line_id;
            dataBaseManipulation($sql4,con(),"result","deleteing from categoty amount",true);


    }else{
        $sql5="DELETE FROM Category WHERE category_id=".$category_id;
        dataBaseManipulation($sql5,con(),"result","delete category",true);
    }

}