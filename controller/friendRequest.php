<?php
/**
 * Created by PhpStorm.
 * User: jmkha
 * Date: 12/4/2016
 * Time: 8:04 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate");
require_once ("../classes/FriendRequest.php");
if(isset($_POST)){
    $friendReq = new FriendRequest((int)$_SESSION["user_id"],(int)$_POST["requestee"]);
    $conn = con();
    $sql = "INSERT INTO friend_request (".createQueryStringKeys($friendReq).") VALUES (".createQueryStringValues($friendReq).")";
     if($result = mysqli_query($conn,$sql)){
         echo "success";
     }else{
         echo "failure ".mysqli_errno($conn);
     }

}else{
    echo "not set";
}