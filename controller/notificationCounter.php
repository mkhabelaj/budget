<?php
    require_once ("../inclusion/inclusion.php");
    AllIncludes("functions","dataB");

    $numberOfNotifications = 0;
    $userID = $_SESSION["user_id"];

    $sql="SELECT * FROM friend_request WHERE State = 'waiting' AND requestee=".$userID;
    $conn = con();

    if($result = mysqli_query($conn,$sql)){
        $numberOfNotifications += mysqli_num_rows($result);
    }else{
        echo $sql."<br>";
        echo "failure ".mysqli_error($conn);
    }

    $sql = "SELECT COUNT(*)AS total FROM notification WHERE state='unseen' AND user_id =".userID();
    if($result = mysqli_query($conn,$sql)):
        while ($row = mysqli_fetch_assoc($result)):
           $numberOfNotifications += (int)$row["total"];
        endwhile;
    endif;
    echo $numberOfNotifications;
?>



