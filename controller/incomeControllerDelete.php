<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-13
 * Time: 06:36 PM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","income");

if(isset($_POST)){
    $time_line_id = $_POST["timeLineId"];
    $budget_id = $_POST["budgetId"];
    $income_id = $_POST["income"];
    $sql="SELECT COUNT(*) AS total FROM income WHERE time_line_id=".$time_line_id." AND budget_instance_ID=".$budget_id;
    if ( dataBaseManipulation($sql,con(),"rows","selecting from income",false)["total"] > 1):
        $sql="DELETE  FROM income WHERE income_id=".$income_id;
        dataBaseManipulation($sql,con(),"conn","deleting from income",false);
    else:
        printItem(concat_with_PTag("Cannot delete because each budget must have at least on income"));

    endif;
    //dataBaseManipulation(SQLInsert("income",$incomeObj),con(),"result","inserting into incom",true);
}