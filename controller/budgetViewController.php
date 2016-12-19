<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-19
 * Time: 10:32 AM
 */
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("functions")->Inclusion();
factory()->getInclusion("dataB")->Inclusion();
require_once ("../classes/TimeLine.php");


/**
 * @todo get the active endate and startdate from time_line budget, also get the frequency of the time_line
 * @todo find out if the date in the time line is still valid meaning endate is not passed todays date
 * @todo if the endate is not valid deactive the current time_line and create a new time line using the endate of the last time line
 * @todo also create functionality that ensures that the endate is a valid to become the new start date
 * @todo return a budget table
 */



if(isset($_POST)){
    $today=  date("Y/m/d");
    $frequecy;
    $startDate;
    $endDate;
    $timeline_id;
    $budgetid = $_POST["budgetId"];
    $conn = con();
    $sql = "SELECT * FROM time_line WHERE state ='active' AND budget_Instance_ID =".$budgetid;


    if($result = mysqli_query($conn,$sql)){
        echo "success <br>";

        while ($row =mysqli_fetch_assoc($result)){
            $frequecy =$row["frequency"];
            $startDate = date_create($row["duration_start"]);
            $endDate= date_create($row["duration_end"]);
        }
    }else{
        echo "failure ".mysqli_error($conn);
        echo "<br>".$sql;
    }
//    if($today == returnStandardFormat($startDate)){
//        echo "wow these dates are equal <br>";
//    }else{
//        echo "wow these dates are not equal <br>";
//    }
    if($today > returnStandardFormat($endDate) && $today > returnStandardFormat($startDate)){
//        echo "today is less than <br>";
//        echo "endate".returnStandardFormat($endDate)."<br>";
//        echo "today".$today."<br>";
        if($frequecy == "weekly"){
            while (true){
                //todo: check if new endate is valid, the add 7 days until new timeline is valid
                //todo: turn this into a function so that it will be flexible with future time lines
            }
        }else if($frequecy == "biweekly"){
            while (true){
                //todo: check if new endate is valid, the add 14 days until new timeline is valid
            }
        }else {
            //todo validate new date and insert into new time line
            //$new_timeline = new TimeLine();
            $sql="UPDATE time_line SET state='deactivated' WHERE budget_Instance_ID =".$budgetid;
            //todo: insert new time line
            //$sql="INSERT INTO"
            mysqli_query($conn,$sql);
            echo "in budget";
        }



    }else{
        echo "endate is greater <br>";
        echo "endate".returnStandardFormat($endDate)."<br>";
        echo "today".$today."<br>";
    }
}

?>


