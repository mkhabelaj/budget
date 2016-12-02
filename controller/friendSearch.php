<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-02
 * Time: 01:50 PM
 */

include "../inclusion/inclusion.php";
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();
require_once ("../classes/User.php");


if(isset($_GET)){

    $query = $_GET["query"];
    $conn = con();
    $sql = "SELECT user_id, firstname,last_name FROM user WHERE firstname LIKE "."'%".$query."%'";
    

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)){
            echo "<br>".$row["firstname"];
        }
    }


}