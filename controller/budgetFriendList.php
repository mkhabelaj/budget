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

$sql ="SELECT * FROM `friends_with_budgets` 
WHERE (friend_user_id =".$userID."
    OR own_user_id = ".$userID.")
AND (budget_Instance_ID IS NULL
OR budget_Instance_ID <> ".$budgetID.")
GROUP By user_id
";

if($result = mysqli_query($conn,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <div>
            <?php echo $row["firstname"]." ".$row["last_name"]?>
            <button value="<?php echo $row["user_id"]?>" >+</button>
        </div>

        <?php

    }
}else{
    echo "sffsdf";
}

