<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2017-01-12
 * Time: 12:20 PM
 */
require_once("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","preference");

if($_POST){

    $form_name = $_POST["formName"];
    if($form_name=="change-currency"){

        $currency_code = $_POST["currencyCode"];
        $pref = new Preference($currency_code,userID());
        unsetProperties($pref,"user_id");
        dataBaseManipulation(SQLUpdate("preference",$pref,"user_id",userID()),con(),"result","updating pref",false);
        $sql2="SELECT c.code FROM preference AS p
                    INNER JOIN currency AS c
                    ON p.currency_id = c.curency_id
                    WHERE p.user_id =".userID();
        $_SESSION["code"] = dataBaseManipulation($sql2,con(),"rows","Get country code",false)["code"];
    }
}