<?php
/**
 * Created by PhpStorm.
 * User: jmkha
 * Date: 12/4/2016
 * Time: 8:16 PM
 */
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();
require_once ("../classes/Friend.php");
if(isset($_POST)){
    $userID = $_SESSION["user_id"];
    $friendID = $_POST["requester"];
    $friend = new Friend($userID,$friendID);
    $reverseFriend = new Friend($friendID,$userID);

    $sql ="UPDATE friend_request
        SET state='accepted'
         WHERE requestee=".$userID
        ." And requester =".$friendID;
    $conn = con();

    if($result = mysqli_query($conn,$sql)){
        echo "success";
    }else{
        echo "failure ".mysqli_error($conn);
        echo "<br> ".$sql;
    }

    $conn = con();
    $sql = "INSERT INTO friends (".createQueryStringKeys($friend).") VALUES (".createQueryStringValues($friend)."),(".createQueryStringValues($reverseFriend).")";

    if($result = mysqli_query($conn,$sql)){
        echo "success";
    }else{
        echo "failure ".mysqli_error($conn);
    }
}
