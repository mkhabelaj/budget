<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-28
 * Time: 12:34 PM
 */
 require_once("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
if(!is_admin()) header("Location: ../views/index.php");
factory()->getInclusion("header")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();

$conn = con();

$sql = "SELECT user_id, firstname, last_name, email FROM user";
$result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){
        ?>
        <select >
        <?php
        while($row = mysqli_fetch_assoc($result)){
            //echo $row["firstname"]." <br>".$row["email"];
            ?>
            <option value="<?php echo $row["user_id"]?>"><?php echo $row["firstname"]?></option>
            <?php

        }
        ?>
        </select>
        <?php



    }else{
        echo "0 results";

    }

    $conn->close();


?>
<br>
<br>
<form id="form">
    <input name="firstname" value="junior">
    <input type="email" value="email">
    <input type="submit">
</form>





<?php factory()->getInclusion("footer")->Inclusion();?>
<script type="application/javascript" src="../js/adminView.js"></script>
