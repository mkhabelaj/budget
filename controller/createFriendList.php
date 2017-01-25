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

?>
<h3 id="friend-list-header">Friend List</h3>
<ul class="friend-list-item">
<?php
if($result = mysqli_query($conn,$sql)){
    while ($row = mysqli_fetch_assoc($result)){
        ?>
        <li>
            <div class="row">
                <div class="colm-6 override">
                    <img class="friend-img" src="<?php
                    $sqlP="SELECT url FROM photos WHERE status='active' AND user_id=".$row["user_id"];
                    if($url = dataBaseManipulation($sqlP,con(),"rows","selecting from photos",false)["url"]){
                        printItem( $url);
                    }else{
                        printItem("../photos/no_image.PNG");
                    }

                    ?>">
                </div>
                <div class="colm-6 override">
                    <?php echo ucfirst($row["firstname"])." ".ucfirst($row["last_name"])." ";?>
                </div>
            </div>
        </li>
<!--        echo $row["firstname"]." ".$row["last_name"]."<br>";-->
    <?php
    }
}else{
    echo "sffsdf";
}
?>
</ul>
