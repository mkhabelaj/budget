<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-05
 * Time: 10:45 AM
 */
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();

$userID = $_SESSION["user_id"];
$conn =con();
$sql="SELECT
            u2.user_id AS requester_id,
            u2.firstname AS requester_name,
            u2.last_name AS requester_lastname
        FROM user AS u
        INNER JOIN friend_request as fr
        ON u.user_id = fr.requestee
        INNER JOIN user as u2
        ON u2.user_id = fr.requester
        WHERE fr.state = 'waiting'
        AND u.user_id = ".$userID;

$result = mysqli_query($conn,$sql);
if($result){
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <div>
            <?php
                echo $row["requester_name"]." ".$row["requester_lastname"]." ";
            ?>
            <button value="<?php echo $row["requester_id"]?>" name="accept" class="acceptFriendR">Accept</button>
            <button value="<?php echo $row["requester_id"]?>" name="accept" class="denyFriendR">Deny</button>
        </div>
        <?php
    }
}

$sql = "SELECT notification_id, message FROM notification WHERE state='unseen' AND user_id=".userID();
if($result = mysqli_query($conn,$sql)){
    while($row = mysqli_fetch_assoc($result)):
        ?>
            <div>
                <?php echo $row["message"]; ?>
                <button class="dismiss" value="<?php echo $row["notification_id"]; ?>">Dismiss</button>
            </div>
        <?php
    endWhile;
}



