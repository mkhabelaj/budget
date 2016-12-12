<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-12
 * Time: 03:37 PM
 */

require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();


//if(isset($_POST)){
    $messageType =  $_POST["type"];
    $recieverID =$_POST["user_id"];

    echo userID()." ".lastname()." ".name();

    //if($messageType === "accepted"){

    //}

//}