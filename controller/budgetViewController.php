<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-19
 * Time: 10:32 AM
 */
require_once ("../inclusion/inclusion.php");
AllIncludes("functions","dataB","validate","timeL","categoryA","income","categoryS");

$frequency;
$startDate;
$endDate;
$time_line_id;
$new_time_line;
$resetDay;
$new_start_date;
$new_end_date;
$budget_id;
$category_array = [];
$income_array = [];
$category_state_array =[];

/**
 * gets all the old value of the category amounts and store it to a $category_array
 */
function getCategoryAmounts(){
    global $time_line_id;
    global $budget_id;
    global $category_array;
    $sql ="SELECT 
	c.category_id,
    c.name,
    CA.projected_amount,
    CA.actual_amount,
	BIC.budget_Instance_id,
    CS.time_line_id
FROM `category_state` AS CS
	INNER JOIN category AS C
		ON C.category_id = CS.category_id
	INNER JOIN budget_instance_catagory AS BIC
		ON C.category_id = BIC.catagory_id
    INNER JOIN category_amounts AS CA
    	ON c.category_id = CA.catergory_id
WHERE BIC.budget_Instance_id =".$budget_id." 
AND CS.state = 'active'
AND ca.time_line_id=".$time_line_id."
AND CS.time_line_id =".$time_line_id." ";
    $result = dataBaseManipulation($sql,con(),"result","selecting table categories array store",false);
    while ($row = mysqli_fetch_assoc($result)){
        $category_array[]= $row;
    }
}

/**
 * gets all the old value of the category income and store it to a $income_array
 */
function  getBudgetIncome(){
    global $time_line_id;
    global $income_array;
    $sql_income ="SELECT * FROM income WHERE `time_line_id`=".$time_line_id;
    $result = dataBaseManipulation($sql_income,con(),"result","selecting from income array store",false);
    while ($row = mysqli_fetch_assoc($result)){
        $income_array[]= $row;
    }
}

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
        //echo "success <br>";

        while ($row =mysqli_fetch_assoc($result)){
            $frequency =$row["frequency"];
            $startDate = date_create($row["duration_start"]);
            $endDate= date_create($row["duration_end"]);
            $resetDay =(int) strlen($row["reset_day"]) > 1 ? $row["reset_day"] : "0".$row["reset_day"];
            $time_line_id = $row["time_line_id"];
        }
    }else{
        //echo "failure ".mysqli_error($conn);
        //echo "<br>".$sql;
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
    deactivateCategoryState();

    mysqli_query($conn,$sql);
    $sql = "INSERT INTO time_line (".createQueryStringKeys($new_time_line).") VALUES (".createQueryStringValues($new_time_line).")";
    mysqli_query($conn,$sql);
    //createBreak();
    //var_dump($new_time_line);
}

/**
 * deactivates old active states
 */
function deactivateCategoryState(){
    global $time_line_id;
    $sql ="UPDATE category_state SET `state`='deactivated' WHERE time_line_id=".$time_line_id;
    dataBaseManipulation($sql,con(),"result","deactivate category state",false);
}

/**
 * this function inserts all the value from $category_array and $income_array into there repective databases
 */
function insertOldValueToNew(){
    global $category_array;
    global $income_array;
    global $time_line_id;
    global $budget_id;
    if($category_array):
        foreach ($category_array as $array){
            if($array):
                dataBaseManipulation(SQLInsert("category_amounts",new CategoryAmount(0,$array["projected_amount"],$array["category_id"],$time_line_id)),con(),"result","inerting old cat amounts into new",false);
                dataBaseManipulation(SQLInsert("category_state",new CategoryState($time_line_id,$array["category_id"])),con(),"result","inserting into category state",false);
            endif;
        }
    endif;
    if($income_array):
        foreach ($income_array as $array){
            if($array):
                dataBaseManipulation(SQLInsert("income",new Income($array["income"],$budget_id,$time_line_id,$array["description"],$array["user_id"])),con(),"result","inserting old value into new income",false);
            endif;
        }
    endif;
}

/**
 * date validation
 */
if(isset($_POST)){
    $sqlCheck = "SELECT * FROM user_budget_instance WHERE user_id=".userID()." AND budget_instance_ID=".$_POST["budgetId"];
    if(!$row = dataBaseManipulation($sqlCheck,con(),"rows","selecting from ubi",false)){
        //@todo add notification system
        exit();
    }
    //$today = date("Y-m-d",strtotime("Jan 1 2016"));
    //$today = date("Y-m-d",strtotime("dec 15 2016"));
    //$today = date("Y-m-d",strtotime("Jan 15 2017"));
    //$today = date("Y-m-d",strtotime("aug 15 2017"));
    $today=  date("Y-m-d");
    getCurrentBudgetInformation();

    if($today > returnStandardFormat($endDate) && $today > returnStandardFormat($startDate)){
        getBudgetIncome();
        getCategoryAmounts();
        if($frequency == "weekly"){

            $compare_date = $endDate;
           // echo returnStandardFormat($compare_date);
            //createBreak();
            $compare_date = addSubDaysToDate($endDate,7,"+");
            //createBreak();
          //  echo "in while loop";
            while (true){
                if($today >= $compare_date){
                   // echo calculateDaysMonth($compare_date,1,"-",false);
                    //createBreak();
                    //createBreak();
                   // echo $compare_date;
                    //createBreak();

                } else{
                    //echo "what";
                    //createBreak();
                    $new_start_date = addSubDaysToDate(date_create($compare_date),7,"-");
                    $new_end_date = $compare_date;
                    $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                    break;
                                    }
                $compare_date = addSubDaysToDate(date_create($compare_date),7,"+");
            }
            //echo "in week";
            deactivatesOldBudgetActivateNew();
            getCurrentBudgetInformation();
            insertOldValueToNew();
        }else if($frequency == "biweekly"){

            $compare_date = $endDate;
            // //echo returnStandardFormat($compare_date);
            //createBreak();
            $compare_date = addSubDaysToDate($endDate,14,"+");
            //createBreak();
            //echo "in while loop";
            while (true){
                if($today >= $compare_date){
                    // echo calculateDaysMonth($compare_date,1,"-",false);
                    //createBreak();
                    //createBreak();
                    //echo $compare_date;
                    //createBreak();

                } else{
                    //echo "what";
                    //createBreak();
                    $new_start_date = addSubDaysToDate(date_create($compare_date),7,"-");
                    $new_end_date = $compare_date;
                    $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                    break;
                }
                $compare_date = addSubDaysToDate(date_create($compare_date),7,"+");
            }
            //echo "in BIweek";
            deactivatesOldBudgetActivateNew();
            getCurrentBudgetInformation();
            insertOldValueToNew();
        }else {
            $temp = $endDate;
            //echo "reset day ".$resetDay;
            //echo "<br>";
           if(((strtotime($today) -  strtotime(returnStandardFormat($endDate)))/(4 * 7 * 24 * 60 * 60 )) > 1){
               if(date_create($today)->format("d") < $resetDay){
                   //echo "todays day is less than the reset day";
                   //createBreak();
                   if(calculateDaysMonth(date_create($today),1,"-",true)> $resetDay){
                       //echo "last months days are greater than the reset day";
                       //createBreak();
                       //echo "new start date ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),$resetDay);
                       $new_start_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),$resetDay);
                       //createBreak();
                       if( calculateDaysMonth(date_create($today),0,"+",true)> $resetDay){
                           //echo "the reset day is less than today's month";
                           //createBreak();
                           //echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           //createBreak();
                       }else{
                           //echo "the reset day are greater than today's months";
                           //createBreak();
                           //echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
                           //createBreak();
                       }

                       $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                       $new_time_line->reset_day =(int) $resetDay;

                   }else{
                       //echo "last months days are less than the reset day";
                       //createBreak();
                       //echo "new start date ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),calculateDaysMonth(date_create($today),1,"-",true));
                       $new_start_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"-",false),calculateDaysMonth(date_create($today),1,"-",true));
                       //createBreak();
                       if( calculateDaysMonth(date_create($today),0,"+",true)> $resetDay){
                           //echo "the reset day is less than today's month";
                           //createBreak();
                           //echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),$resetDay);
                           //createBreak();
                       }else{
                           //echo "the reset day are greater than today's months";
                           //createBreak();
                           //echo "new endDate ".createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
                           $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),0,"+",false),calculateDaysMonth(date_create($today),0,"+",true));
                           //createBreak();
                       }
                       $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                       $new_time_line->reset_day =(int) $resetDay;
                   }

               }else{
                   //echo "todays day is greater than the reset day";
                   //createBreak();
                   if(calculateDaysMonth(date_create($today),1,"+",true)> $resetDay){
                       $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"+",false),$resetDay);
                       //echo "new end day ".$new_end_date;
                       //createBreak();
                   }else{
                       $new_end_date = createDateUsingStringWithAnyDay(calculateDaysMonth(date_create($today),1,"+",false),calculateDaysMonth(date_create($today),1,"+",true));
                       //echo "new end day ".$new_end_date;
                       //createBreak();
                   }
                   //echo "new start date ".date_create($today)->format("Y-m-".$resetDay);
                   $new_start_date = date_create($today)->format("Y-m-".$resetDay);
                   $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                   $new_time_line->reset_day =(int) $resetDay;
               }

           }else{

               $resultDate;
               $resultDate = date ('Y-m-d',strtotime("+1 months",strtotime($temp->format('Y-m-01'))));
               $numberOfDaysInFutureMonth =cal_days_in_month(CAL_GREGORIAN,date ("m",strtotime($resultDate)),date ("Y",strtotime($resultDate)));
              if($numberOfDaysInFutureMonth > $resetDay){
                  //echo "new end day".date_create($resultDate)->format("Y-m-".$resetDay);
                  $new_end_date = date_create($resultDate)->format("Y-m-".$resetDay);
                  $new_start_date = $endDate->format("Y-m-d");
                  //echo "<br>";
                  $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                  $new_time_line->reset_day =(int) $resetDay;
              }else{
                  //echo "new end day".date_create($resultDate)->format("Y-m-".$numberOfDaysInFutureMonth);
                  $new_end_date = date_create($resultDate)->format("Y-m-".$numberOfDaysInFutureMonth);
                  $new_start_date = $endDate->format("Y-m-d");
                  //echo "<br>";
                  $new_time_line = new TimeLine($new_start_date,$new_end_date,$frequency,$budget_id);
                  $new_time_line->reset_day =(int) $resetDay;
              }
           }


            deactivatesOldBudgetActivateNew();
            getCurrentBudgetInformation();
            insertOldValueToNew();
        }


    }else{
        //echo "endate is greater <br>";
        //echo "endate".returnStandardFormat($endDate)."<br>";
        //echo "today".$today."<br>";
    }
}


$sql ="SELECT 
	c.category_id,
    c.name,
    CA.projected_amount,
    CA.actual_amount,
	BIC.budget_Instance_id,
    CS.time_line_id
FROM `category_state` AS CS
	INNER JOIN category AS C
		ON C.category_id = CS.category_id
	INNER JOIN budget_instance_catagory AS BIC
		ON C.category_id = BIC.catagory_id
    INNER JOIN category_amounts AS CA
    	ON c.category_id = CA.catergory_id
WHERE BIC.budget_Instance_id =".$budget_id." 
AND CS.state = 'active'
AND ca.time_line_id=".$time_line_id."
AND CS.time_line_id =".$time_line_id." ";
$sql_income ="SELECT * FROM income WHERE `time_line_id`=".$time_line_id;

$result = dataBaseManipulation($sql,con(),"result","selecting table categories",false);
$result1 = dataBaseManipulation($sql,con(),"result","selecting table categories",false);
$result2 = dataBaseManipulation($sql_income,con(),"result","selecting from income",false);

$total_projected=0;
$total_actual =0;
$total_projected_for_income =0;
$total_actual_for_income =0;
$total_income=0;

while ($row = mysqli_fetch_assoc($result1)):
    $total_projected_for_income+=$row["projected_amount"];
    $total_actual_for_income+=$row["actual_amount"];
endwhile;
while ($row = mysqli_fetch_assoc($result2)):
    $total_income+= $row["income"];
endwhile;
?>
<div class="row">
    <div id="income-summary" class="colm-12">
        <div class="row">
            <div class="colm-3 open-modal" id="income-open" data-time-id="<?php printItem($time_line_id)?>" data-budget-id="<?php printItem($budget_id)?>">
                <p>Total Income</p>
                <p><?php printItem(currencyCode())?></p>
                <p><?php printItemCurrency($total_income)?></p>
            </div>
            <div class="colm-3">
                <p>Total Projected</p>
                <p><?php printItem(currencyCode())?></p>
                <p><?php printItemCurrency($total_projected_for_income)?></p>
            </div>
            <div class="colm-3">
                <p>Total Actual Spent</p>
                <p><?php printItem(currencyCode())?></p>
                <p><?php printItemCurrency($total_actual_for_income)?></p>
            </div>
            <div class="colm-3">
                <p>Total Varience</p>
                <p><?php printItem(currencyCode())?></p>
                <p><?php printItemCurrency($total_income - $total_actual_for_income)?></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div id="budgetContainer" class="colm-12 center">
        <table id="actualBudget">
            <tr id="table-row-categry">
                <th class="table-header-category">Category</th>
                <th class="table-header-category">Projected Amount</th>
                <th class="table-header-category">Actual Amount</th>
                <th class="table-header-category">Variance</th>
            </tr>

    <?php
    while ($row = mysqli_fetch_assoc($result)):
        $total_projected+=$row["projected_amount"];
        $total_actual+=$row["actual_amount"];
    ?>
            <tr class="open-modal budget-td">
                <td data-currency="<?php printItem(currencyCode()) ?>" data-category-id = "<?php printItem($row["category_id"])?>"><?php printItem($row["name"])?></td>
                <td budget-td><span><?php printItem(currencyCode())?>&nbsp;</span> <?php printItemCurrency($row["projected_amount"])?></td>
                <td><span><?php printItem(currencyCode())?>&nbsp;</span> <?php printItemCurrency($row["actual_amount"])?></td>
                <td><span><?php printItem(currencyCode())?>&nbsp;</span> <?php printItemCurrency($row["projected_amount"] - $row["actual_amount"])?></td>
            </tr>
    <?php
    endwhile;
    ?>
            <tr id="total-row">
                <td>TOTAL</td>
                <td>
                    <p><?php printItem(currencyCode())?></p>
                    <p><?php printItemCurrency($total_projected )?></p>
                </td>
                <td>
                    <p><?php printItem(currencyCode())?></p>
                    <p><?php printItemCurrency( $total_actual) ?></p>
                </td>
                <td>
                    <p><?php printItem(currencyCode())?></p>
                    <p><?php printItemCurrency($total_projected - $total_actual) ?></p>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <button id="add-catagory" class="open-modal" data-budgetID="<?php printItem($budget_id)?>"  data-timeID="<?php printItem($time_line_id) ?>">ADD</button>
                </td>
            </tr>
        </table>
    </div>
</div>
<?php

?>

