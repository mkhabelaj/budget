<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-12
 * Time: 03:37 PM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB");
require_once ("../classes/Notification.php");


if(isset($_POST)){
    $messageType =  $_POST["type"];
    $requestersID =$_POST["requestersID"];
    $conn = con();

    /**
     * the section of this code sends a update to the notification database
     */

    if($messageType === "accepted"){
        $notify = new Notification("you request has be accepted from your friend ".name()." ".lastname(),(int) $requestersID);
        $sql ="INSERT INTO  notification (".createQueryStringKeys($notify).") VALUES (".createQueryStringValues($notify).")";

        if($result= mysqli_query($conn,$sql)){
            echo "success";
        }else{
            echo "Faliure ".mysqli_error($conn);
        }

    }

}