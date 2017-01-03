<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-28
 * Time: 03:46 PM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB");
require_once ("../classes/BudgetInstance.php");
require_once ("../classes/Income.php");
require_once ("../classes/TimeLine.php");
require_once ("../classes/UserBudgetInstance.php");


if(isset($_POST)){

    $budget_instance = new BudgetInstance($_POST["budgetName"]);
    $budget_id = 0;
    $time_line_id=0;
    $sql="INSERT INTO budget_instance  (".createQueryStringKeys($budget_instance).") VALUES (".createQueryStringValues($budget_instance).")";
    $conn = con();
    //insert into budget instance
    if($result = mysqli_query($conn,$sql)){
        echo"record successfully create";
        $budget_id  = mysqli_insert_id($conn);

        //insert into user budget instance
        $userBudgetI = new UserBudgetInstance($budget_id,(int) $_SESSION["user_id"]);
        $sql4="INSERT INTO user_budget_instance (".createQueryStringKeys($userBudgetI).")VALUES (".createQueryStringValues($userBudgetI).")";
        //echo $sql4;
        if($result3 = mysqli_query($conn,$sql4)){
            echo "insert into user b succes <br>";
        }else{
            echo "User be failiure ".mysqli_error($conn);
        }

        //insert into timeline
        $time_line = new TimeLine($_POST["startDate"],$_POST["endDate"],$_POST["frequency"],$budget_id);
        if($_POST["frequency"] == "monthly"){
            $time_line->reset_day = (int)date_create($_POST["startDate"])->format("d");
            $time_line_id = mysqli_insert_id(dataBaseManipulation(SQLInsert("time_line",$time_line),con(),"conn","inserting into time line for monthly",true));
        }else{
            $sql3 ="INSERT INTO time_line (".createQueryStringKeys($time_line).") VALUES (".createQueryStringValues($time_line).")";
            $time_line_id = mysqli_insert_id(dataBaseManipulation(SQLInsert("time_line",$time_line),con(),"conn","inserting into time line not monthly",true));

        }

        $income = new Income($_POST["income"],$budget_id,$time_line_id);
        dataBaseManipulation(SQLInsert("income",$income),con(),"result","inserting to income",true);

        header("Location: ../views/budget.php");

    }else{
        echo "failed";
    }



    //echo $sql;
}