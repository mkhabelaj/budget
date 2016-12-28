<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-13
 * Time: 12:31 PM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB");

if(isset($_POST)):
    $conn = con();
    $notificationID = $_POST["notficationID"];
    $sql ="UPDATE notification SET state = 'seen' WHERE notification_id =". $notificationID;
    if($result = mysqli_query($conn,$sql)):
        echo "succees";
    else:
        echo "faliure ".mysqli_error($conn);
    endif;

endif;