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
    //$today=  date("Y-m-d");
    //$today = date("Y-m-d",strtotime("Jan 15 2016"));
    //$today = date("Y-m-d",strtotime("Oct 15 2016"));
    //$today = date("Y-m-d",strtotime("Jan 15 2017"));
    //$today = date("Y-m-d",strtotime("mar 15 2017"));
    $today = date("Y-m-d",strtotime("feb 28 2017"));
    $frequency;
    $startDate;
    $endDate;
    $time_line_id;
    $resetDay;
    $new_start_date;
    $new_end_date;
    $budget_id = $_POST["budgetId"];
    $conn = con();
    $sql = "SELECT * FROM time_line WHERE state ='active' AND budget_Instance_ID =".$budget_id;


    if($result = mysqli_query($conn,$sql)){
        echo "success <br>";

        while ($row =mysqli_fetch_assoc($result)){
            $frequency =$row["frequency"];
            $startDate = date_create($row["duration_start"]);
            $endDate= date_create($row["duration_end"]);
            $resetDay =(int) strlen($row["reset_day"]) > 1 ? $row["reset_day"] : "0".$row["reset_day"];
        }
    }else{
        echo "failure ".mysqli_error($conn);
        echo "<br>".$sql;
    }

    if($today > returnStandardFormat($endDate) && $today > returnStandardFormat($startDate)){
        if($frequency == "weekly"){

            $compare_date = $endDate;
           // echo returnStandardFormat($compare_date);
            createBreak();
           echo $compare_date = addSubDaysToDate($endDate,7,"+");
            createBreak();
            echo "in while loop";
            while (true){
                if($today >= $compare_date){
                   // echo calculateDaysMonth($compare_date,1,"-",false);
                    createBreak();
                    createBreak();
                    echo $compare_date;
                    createBreak();

                } else{
                    echo "what";
                    createBreak();
                    $new_start_date = addSubDaysToDate(date_create($compare_date),7,"-");
                    $new_end_date = $compare_date;
                    $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                    var_dump($new_time_line);
                    break;
                                    }
                $compare_date = addSubDaysToDate(date_create($compare_date),7,"+");
            }
            echo "in week";
            createBreak();
        }else if($frequency == "biweekly"){

            $compare_date = $endDate;
            // echo returnStandardFormat($compare_date);
            createBreak();
            echo $compare_date = addSubDaysToDate($endDate,14,"+");
            createBreak();
            echo "in while loop";
            while (true){
                if($today >= $compare_date){
                    // echo calculateDaysMonth($compare_date,1,"-",false);
                    createBreak();
                    createBreak();
                    echo $compare_date;
                    createBreak();

                } else{
                    echo "what";
                    createBreak();
                    $new_start_date = addSubDaysToDate(date_create($compare_date),7,"-");
                    $new_end_date = $compare_date;
                    $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                    var_dump($new_time_line);
                    break;
                }
                $compare_date = addSubDaysToDate(date_create($compare_date),7,"+");
            }
            echo "in BIweek";
            createBreak();
        }else {
            $new_time_line;
            $temp = $endDate;
            echo "reset day ".$resetDay;
            echo "<br>";
           if(((strtotime($today) -  strtotime(returnStandardFormat($endDate)))/(4 * 7 * 24 * 60 * 60 )) > 1){
               if(date_create($today)->format("d") < $resetDay){
                   echo "todays day is less than the reset day";
                   createBreak();
                   if(calculateDaysMonth(date_create($today),1,"-",true)> $resetDay){
                       echo "last months days are greater than the reset day";
                       createBreak();
                       echo "new start date ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),$resetDay);
                       $new_start_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),$resetDay);
                       createBreak();
                       if( calculateDaysMonth(date_create($today),0,"+",true)> $resetDay){
                           echo "the reset day is less than today's month";
                           createBreak();
                           echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           createBreak();
                       }else{
                           echo "the reset day are greater than today's months";
                           createBreak();
                           echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today)->format("Y-m-d"),0,"+",true));
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today)->format("Y-m-d"),0,"+",true));
                           createBreak();
                       }

                       $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                       $new_time_line->reset_day =(int) $resetDay;

                   }else{
                       echo "last months days are less than the reset day";
                       createBreak();
                       echo "new start date ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),calculateDaysMonth(date_create($today),1,"-",true));
                       $new_start_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),calculateDaysMonth(date_create($today),1,"-",true));
                       createBreak();
                       if( calculateDaysMonth(date_create($today),0,"+",true)> $resetDay){
                           echo "the reset day is less than today's month";
                           createBreak();
                           echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           createBreak();
                       }else{
                           echo "the reset day are greater than today's months";
                           createBreak();
                           echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today)->format("Y-m-d"),0,"+",true));
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today)->format("Y-m-d"),0,"+",true));
                           createBreak();
                       }
                       $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                       $new_time_line->reset_day =(int) $resetDay;
                   }

               }else{
                   echo "todays day is greater than the reset day";
                   createBreak();
                   if(calculateDaysMonth(date_create($today),1,"+",true)> $resetDay){
                       echo "new end day ".$new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"+",false),$resetDay);
                       createBreak();
                   }else{
                       echo "new end day ".$new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"+",false),calculateDaysMonth(date_create($today),1,"+",true));
                       createBreak();
                   }
                   echo "new start date ".date_create($today)->format("Y-m-".$resetDay);
                   $new_start_date = date_create($today)->format("Y-m-".$resetDay);
                   $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                   $new_time_line->reset_day =(int) $resetDay;
               }

           }else{

               $resultDate;
               $resultDate = date ('Y-m-d',strtotime("+1 months",strtotime($temp->format('Y-m-01'))));
               $numberOfDaysInFutureMonth =cal_days_in_month(CAL_GREGORIAN,date ("m",strtotime($resultDate)),date ("Y",strtotime($resultDate)));
              if($numberOfDaysInFutureMonth > $resetDay){
                  echo "new end day".date_create($resultDate)->format("Y-m-".$resetDay);
                  $new_end_date = date_create($resultDate)->format("Y-m-".$resetDay);
                  $new_start_date = $endDate->format("Y-m-d");
                  echo "<br>";
                  $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                  $new_time_line->reset_day =(int) $resetDay;
              }else{
                  echo "new end day".date_create($resultDate)->format("Y-m-".$numberOfDaysInFutureMonth);
                  $new_end_date = date_create($resultDate)->format("Y-m-".$numberOfDaysInFutureMonth);
                  $new_start_date = $endDate->format("Y-m-d");
                  echo "<br>";
                  $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                  $new_time_line->reset_day =(int) $resetDay;
              }

           }

           $sql="UPDATE time_line SET state='deactivated' WHERE state ='active' AND budget_Instance_ID =".$budget_id;

            mysqli_query($conn,$sql);
            $sql = "INSERT INTO time_line (".createQueryStringKeys($new_time_line).") VALUES (".createQueryStringValues($new_time_line).")";
            mysqli_query($conn,$sql);
            echo " <br>in budget";
            createBreak();

            var_dump($new_time_line);
        }


    }else{
        echo "endate is greater <br>";
        echo "endate".returnStandardFormat($endDate)."<br>";
        echo "today".$today."<br>";
    }
}

?>


