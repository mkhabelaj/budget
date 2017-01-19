<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-14
 * Time: 05:12 AM
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
    $income_id = $_POST["income-id"];
    $income_amount =(double) $_POST["amount-name"];
    $description = $_POST["description-name"];

    if(isNull($income_amount)){
        $error.= concat_with_PTag("Income Amount is empty");
        set_is_vaild_false();
    }

    if(isNull($description)){
        $error.= concat_with_PTag("Description is empty");
        set_is_vaild_false();

    }

    if(!is_numeric($income_amount)){
        $error.= concat_with_PTag("Income is not number");
        set_is_vaild_false();
    }

    if($is_valid):
        $incomeObj = new Income($income_amount,null,null,$description,null);
        unsetProperties($incomeObj,"user_id","time_line_id","budget_instance_id");
        dataBaseManipulation(SQLUpdate("income",$incomeObj,"income_id",$income_id),con(),"result","updating income",false);

        else:
        printItem($error);
    endif;

}