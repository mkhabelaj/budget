<?php
    require_once ("../inclusion/inclusion.php");
    factory()->getInclusion("functions")->Inclusion();
    factory()->getInclusion("dataB")->Inclusion();

    $numberOfNotifications = 0;
    $userID = $_SESSION["user_id"];

    $sql="SELECT * FROM friend_request WHERE State = 'waiting' AND requestee=".$userID;
    $conn = con();

    if($result = mysqli_query($conn,$sql)){
        //echo "success <br>";
        $numberOfNotifications += mysqli_num_rows($result);
        echo $numberOfNotifications;
    }else{
        echo $sql."<br>";
        echo "failure ".mysqli_error($conn);
    }
?>



