<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-13
 * Time: 06:03 PM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","income");
$is_valid = true;
$error="<p>Failure:</p>";
function set_is_vaild_false(){
    global $is_valid;

    $is_valid = false;
}

if(isset($_POST)){
    $time_line_id = $_POST["timeLineId"];
    $budget_id = $_POST["budgetId"];
    $description = $_POST["description"];
    $income = (double)$_POST["income"];

    if(isNull($income)){
        $error.= concat_with_PTag("Income Amount is empty");
        set_is_vaild_false();
    }

    if(isNull($description)){
        $error.= concat_with_PTag("Description is empty");
        set_is_vaild_false();

    }

    if(!is_numeric($income)){
        $error.= concat_with_PTag("Income is not number");
        set_is_vaild_false();
    }

    if($is_valid):
        $incomeObj = new Income($income,$budget_id,$time_line_id,$description,userID());
        dataBaseManipulation(SQLInsert("income",$incomeObj),con(),"result","inserting into incom",false);
    else:
        printItem($error);
    endif;
}