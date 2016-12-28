<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-02
 * Time: 01:50 PM
 */

include "../inclusion/inclusion.php";
AllIncludes("functions","dataB");
require_once ("../classes/User.php");


if(isset($_POST["query"])){

    $userID = $_SESSION["user_id"];

    $query = $_POST["query"];
    if(strlen($query) > 0){
        $conn = con();
       // $sql = "SELECT user_id, firstname,last_name FROM user WHERE firstname LIKE "."'%".$query."%'";
        $sql ="SELECT 
                    user.user_id,
                    user.firstname, 
                    user.last_name,
                    f.friend_id,
                    fr.state,
                    fr.requester,
                    fr.requestee
                FROM user LEFT JOIN (SELECT * 
                                     FROM friends
                                     WHERE friends.own_user_id =". $userID ."  
                                     OR friends.friend_user_id = ". $userID ." ) 
                                     AS f 
                ON (user.user_id = f.own_user_id OR user.user_id = f.friend_user_id) 
                LEFT JOIN (SELECT * 
                           FROM friend_request 
                           WHERE friend_request.requester =". $userID ."  
                           OR friend_request.requestee =". $userID ." ) AS fr 
                ON user.user_id = fr.requestee or user.user_id = fr.requester";
        //echo $sql;
        $user="";

        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result)>0){
            while ($row = mysqli_fetch_assoc($result)){
                if($row["friend_id"] == null && strpos($row["firstname"], $query)!== false && $userID !== $row["user_id"]){
                    ?>

                    <div >
                        <?php
                            echo $row["firstname"]." ".$row["last_name"]." ";
                            if($row["state"] == "waiting" && $row["state"] !== null){
                                if($_SESSION["user_id"] == $row["requester"]) {
                                    echo "waiting for respone";
                                }else{
                                    ?>
                                    <button class="acceptFriendRequet" value="<?php echo $row["user_id"]?>">Accept</button>
                                    <?php
                                }
                            }else{
                                ?>
                                <button class="friendRequest" value="<?php echo $row["user_id"]?>">Add friend</button>
                                <?php
                            }
                        ?>
                    </div>
                    <?php
                }

            }
        }
    }



}
?>

