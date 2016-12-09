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

$sql1 ="SELECT * FROM `friends_with_budgets` 
WHERE (friend_user_id =".$userID."
    OR own_user_id = ".$userID.")
AND (budget_Instance_ID IS NULL
OR budget_Instance_ID <> ".$budgetID.")
AND user_id <> ".$userID."
GROUP By user_id";

$sql2 ="SELECT * FROM friends AS f LEFT JOIN user_budget_instance AS ubi ON f.friend_user_id = ubi.user_id WHERE f.own_user_id = ".$userID."
NOT IN (SELECT user_id FROM user_budget_instance WHERE budget_Instance_Id =  ".$budgetID." ) OR  budget_Instance_Id is NUll";

$sql = "SELECT
		u.user_id,
        u.firstname,
        u.last_name
FROM user AS u
INNER JOIN (SELECT * FROM
            friends AS f 
            LEFT JOIN user_budget_instance AS ubi 
            ON f.friend_user_id = ubi.user_id
WHERE f.own_user_id = ".$userID."
NOT IN (SELECT user_id FROM user_budget_instance 
        WHERE budget_Instance_Id = ".$budgetID." ) 
        OR  budget_Instance_Id is NUll) AS fr
ON fr.friend_user_id = u.user_id";

if($result = mysqli_query($conn,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="budgetFriendItem">
            <?php echo $row["firstname"]." ".$row["last_name"]?>
            <button class="addFriendToMyB" value="<?php echo $row["user_id"]?>" >+</button>
        </div>

        <?php

    }
}else{
    echo "sffsdf";
}

