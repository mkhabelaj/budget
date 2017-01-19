<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-06
 * Time: 11:36 AM
 */

require_once("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate");

$conn = con();

$userID = $_SESSION["user_id"];
$budgetID = $_POST["budgetId"];

$sql = "SELECT 	user_id,
		firstname,
		last_name
FROM user AS U
INNER JOIN 
        (SELECT f.friend_user_id FROM friends AS f 
        LEFT JOIN user_budget_instance AS ubi 
        ON f.friend_user_id = ubi.user_id
        WHERE f.own_user_id = ".$userID."
        AND f.friend_user_id NOT IN (SELECT user_budget_instance.user_id FROM user_budget_instance 
                                     WHERE budget_Instance_Id = ".$budgetID."  )) AS user_f_b
ON user_f_b.friend_user_id = u.user_id 
GROUP BY u.user_id ";

if($result = mysqli_query($conn,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <div class="budgetFriendItem ">
            <?php echo $row["firstname"]." ".$row["last_name"]?>
            <button class="addFriendToMyB" value="<?php echo $row["user_id"]?>" >+</button>
        </div>

        <?php

    }
}else{
    echo "sffsdf";
}

