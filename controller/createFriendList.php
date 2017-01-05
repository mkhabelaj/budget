<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-05
 * Time: 02:47 PM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate");
$userID = $_SESSION["user_id"];
$conn = con();

$sql ="SELECT * FROM (SELECT * FROM friends As fr
               WHERE  fr.own_user_id = ".$userID." ) AS f
  	  INNER JOIN user AS u2
 	  ON u2.user_id = f.friend_user_id";


if($result = mysqli_query($conn,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        echo $row["firstname"]." ".$row["last_name"]."<br>";
    }
}else{
    echo "sffsdf";
}
