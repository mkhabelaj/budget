<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-06
 * Time: 11:36 AM
 */

require_once("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();

$conn = con();

$userID = $_SESSION["user_id"];
$budgetID = $_POST["budgetId"];

$sql ="SELECT * FROM (SELECT * FROM friends As fr ) AS f
  	  INNER JOIN user AS u2
 	  ON u2.user_id = f.friend_user_id
OR u2.user_id = f.own_user_id
	 LEFT JOIN user_budget_instance AS ubi
      ON ubi.user_id =u2.user_id AND ubi.budget_Instance_ID <> ".$budgetID."
      where  (f.friend_user_id =".$userID."
          OR f.own_user_id = ".$userID.")
      AND u2.user_id <> ".$userID."
               GROUP BY  u2.user_id";



if($result = mysqli_query($conn,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        echo $row["firstname"]." ".$row["last_name"]."<br>";
    }
}else{
    echo "sffsdf";
}
