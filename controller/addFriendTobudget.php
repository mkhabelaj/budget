<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-08
 * Time: 10:57 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB");
require_once ("../classes/UserBudgetInstance.php");


if(isset($_POST)){
    $ubi = new UserBudgetInstance((int)$_POST["budgetId"],(int)$_POST["friendID"]);
    $sql ="INSERT INTO user_budget_instance (".createQueryStringKeys($ubi).") VALUES (".createQueryStringValues($ubi).")";
    $conn = con();

    if($result = mysqli_query($conn,$sql)){
        echo "success";

    }else{
        echo "failure ".mysqli_error($conn);
    }
}


