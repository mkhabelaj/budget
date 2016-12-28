<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-19
 * Time: 10:32 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB");
require_once ("../classes/TimeLine.php");


/**
 * @todo return a budget table
 */

$frequency;
$startDate;
$endDate;
$time_line_id;
$new_time_line;
$resetDay;
$new_start_date;
$new_end_date;
$budget_id;

/**
 *  this function resets the global variables and gets current information from the respective budget
 */
function getCurrentBudgetInformation(){
    global $budget_id;
    global $frequency;
    global $startDate;
    global $endDate;
    global $time_line_id;
    global $resetDay;

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
            $time_line_id = $row["time_line_id"];
        }
    }else{
        echo "failure ".mysqli_error($conn);
        echo "<br>".$sql;
    }
}

/**
 * this function deactivates the old budget and creates a new one
 */
function deactivatesOldBudgetActivateNew(){
    global $new_time_line;
    global  $budget_id;
    $conn = con();
    $sql="UPDATE time_line SET state='deactivated' WHERE state ='active' AND budget_Instance_ID =".$budget_id;

    mysqli_query($conn,$sql);
    $sql = "INSERT INTO time_line (".createQueryStringKeys($new_time_line).") VALUES (".createQueryStringValues($new_time_line).")";
    mysqli_query($conn,$sql);
    createBreak();
    var_dump($new_time_line);
}

if(isset($_POST)){
    $today=  date("Y-m-d");
    getCurrentBudgetInformation();

    if($today > returnStandardFormat($endDate) && $today > returnStandardFormat($startDate)){
        if($frequency == "weekly"){

            $compare_date = $endDate;
           // echo returnStandardFormat($compare_date);
            createBreak();
           echo $compare_date = addSubDaysToDate($endDate,7,"+");
            createBreak();
          //  echo "in while loop";
            while (true){
                if($today >= $compare_date){
                   // echo calculateDaysMonth($compare_date,1,"-",false);
                    createBreak();
                    createBreak();
                   // echo $compare_date;
                    createBreak();

                } else{
                    echo "what";
                    createBreak();
                    $new_start_date = addSubDaysToDate(date_create($compare_date),7,"-");
                    $new_end_date = $compare_date;
                    $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                    break;
                                    }
                $compare_date = addSubDaysToDate(date_create($compare_date),7,"+");
            }
            echo "in week";
            deactivatesOldBudgetActivateNew();
            getCurrentBudgetInformation();
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
                    break;
                }
                $compare_date = addSubDaysToDate(date_create($compare_date),7,"+");
            }
            echo "in BIweek";
            deactivatesOldBudgetActivateNew();
            getCurrentBudgetInformation();
        }else {
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
                           echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
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
                           echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
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


            deactivatesOldBudgetActivateNew();
            getCurrentBudgetInformation();
        }


    }else{
        echo "endate is greater <br>";
        echo "endate".returnStandardFormat($endDate)."<br>";
        echo "today".$today."<br>";

    }
}


?>

<div id="budgetContainer">
    <table id="actualBudget">
        <tr>
            <th>Projected Amount</th>
            <th>Actual Amount</th>
            <th>Variance</th>
        </tr>
        <tr>
            <td>dummy</td>
            <td>dummy</td>
            <td>dummy</td>
        </tr>

    </table>
</div>

<button id="add-catagory" class="open-modal" data-budgetID="<?php printItem($budget_id)?>"  data-timeID="<?php printItem($time_line_id) ?>">Open Modal</button>


