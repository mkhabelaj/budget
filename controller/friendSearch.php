<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-02
 * Time: 01:50 PM
 */

include "../inclusion/inclusion.php";
AllIncludes("functions","dataB","validate","user");
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
                ?>
            <ul class="friend-list-items">
            <?php
            while ($row = mysqli_fetch_assoc($result)){
                if($row["friend_id"] == null && strpos($row["firstname"], $query)!== false && $userID !== $row["user_id"]){
                    ?>

                    <li >
                        <div class="row">
                            <div class="colm-4 override">
                                <img class="friend-img" src="<?php
                                    $sqlP="SELECT url FROM photos WHERE status='active' AND user_id=".$row["user_id"];
                                    if($url = dataBaseManipulation($sqlP,con(),"rows","selecting from photos",false)["url"]){
                                        printItem( $url);
                                    }else{
                                        printItem("../photos/no_image.PNG");
                                    }

                                ?>">
                            </div>
                            <div class="colm-4 override">
                                <?php echo ucfirst($row["firstname"])." ".ucfirst($row["last_name"])." ";?>
                            </div>
                               <?php if($row["state"] == "waiting" && $row["state"] !== null){
                                    if($_SESSION["user_id"] == $row["requester"]) {
                                        echo "waiting for respone";
                                    }else{
                                        ?>
                                        <div class="colm-4 override">
                                         <button class="acceptFriendRequet" value="<?php echo $row["user_id"]?>">Accept</button>
                                        </div>
                                        <?php
                                    }
                                }else{
                                    ?>
                                   <div class="colm-4 override">
                                    <button class="friendRequest" value="<?php echo $row["user_id"]?>">Add friend</button>
                                       </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </li>
                    <?php
                }

            }
            ?>
            </ul>
            <?php
        }
    }



}
?>

