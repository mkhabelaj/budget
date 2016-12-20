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
    $today=  date("Y-m-d");
    //$today = date("Y/m/d",strtotime("Feb 1 2016"));
    $frequecy;
    $startDate;
    $endDate;
    $timeline_id;
    $resetDay;
    $budgetid = $_POST["budgetId"];
    $conn = con();
    $sql = "SELECT * FROM time_line WHERE state ='active' AND budget_Instance_ID =".$budgetid;


    if($result = mysqli_query($conn,$sql)){
        echo "success <br>";

        while ($row =mysqli_fetch_assoc($result)){
            $frequecy =$row["frequency"];
            $startDate = date_create($row["duration_start"]);
            $endDate= date_create($row["duration_end"]);
            //$resetDay =strlen("".$row["reset_day"])<1 ? "0".$row["reset_day"]:$row["reset_day"] ;
            $resetDay =(int) strlen($row["reset_day"]) > 1 ? $row["reset_day"] : "0".$row["reset_day"];
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
            $new_time_line;
            echo strtotime($today);
            echo "<br>";
            echo "reset day ".$resetDay;
            echo "<br>";
            echo strtotime(returnStandardFormat($endDate));
            echo "<br>";
           if(((strtotime($today) - strtotime(returnStandardFormat($endDate)))/(4 * 7 * 24 * 60 * 60 )) > 1){
               echo "adjustment needed";
               echo "<br>";
           }else{
               $temp = $endDate;
               $resultDate;
               $resultDate = date ('Y-m-d',strtotime("+1 months",strtotime($temp->format('Y-m-01'))));
               $numberOfDaysInFutureMonth =cal_days_in_month(CAL_GREGORIAN,date ("m",strtotime($resultDate)),date ("Y",strtotime($resultDate)));
              if($numberOfDaysInFutureMonth > $resetDay){
                  echo "new end day".date_create($resultDate)->format("Y-m-".$resetDay);
                  echo "<br>";
                  $new_time_line = new TimeLine($endDate->format("Y-m-d"),date_create($resultDate)->format("Y-m-".$resetDay),$frequecy,$budgetid);
                  $new_time_line->reset_day = $resetDay;
                  var_dump($new_time_line);
              }else{
                  echo "new end day".date_create($resultDate)->format("Y-m-".$numberOfDaysInFutureMonth);
                  echo "<br>";
                  $new_time_line = new TimeLine($endDate->format("Y-m-d"),date_create($resultDate)->format("Y-m-".$numberOfDaysInFutureMonth),$frequecy,$budgetid);
                  $new_time_line->reset_day = $resetDay;
                  var_dump($new_time_line);
              }

           }

//            $sql="UPDATE time_line SET state='deactivated' WHERE state ='active' AND budget_Instance_ID =".$budgetid;
//            //todo: insert new time line
//            mysqli_query($conn,$sql);
//            $sql = "INSERT INTO time_line (".createQueryStringKeys($new_timeline).") VALUES (".createQueryStringValues($new_timeline).")";
//            mysqli_query($conn,$sql);
            echo " <br>in budget";
        }


    }else{
        echo "endate is greater <br>";
        echo "endate".returnStandardFormat($endDate)."<br>";
        echo "today".$today."<br>";
    }
}

?>


