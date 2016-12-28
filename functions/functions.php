<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-24
 * Time: 03:21 PM
 */
session_start();
//16 Character Key

/**
 * Returns encryption key
 * @return string
 */
function returnKey(){
    return "0828811537082881";
}

//function for SQL

/**
 * Takes any object and converts the variable values into a string and is single quoted and comma separated
 * @param $obj
 * @return string
 */
function createQueryStringValues($obj){
    $sql="";
    $comma = ",";
    $normal_comma =",";
    $sub = -1;
    foreach ($obj as $property => $value){
        if(gettype($value)=="integer"){
            $sql .=  $value.$normal_comma;
        }else{
            $sql .=  "'".$value."'".$comma;
        }

    }
    return substr($sql, 0, $sub);

     return $sql;


}

/**
 * Takes any object and converts the variable names into a string and is single quoted and comma separated
 * @param $obj
 * @return string
 */
function createQueryStringKeys($obj){
    $sql="`";
    $comma = "`,`";
    foreach ($obj as $property => $value){
        $sql .=  $property.$comma;
    }
    return substr($sql, 0, -2);
}

/**
 * takes a variable and covers it in single Quotes
 * @param $var
 * @return string
 */
function createQueryStringForVariable($var){
    return "'".$var."'";
}

//validation

/**
 * Checks to see if user is logged in
 * @return bool
 */
function is_logged_in(){
  if(isset($_SESSION['email'])&& isset($_SESSION["name"])){
      return true;
  }else{
      return false;
  }
}

/**
 * logs out users
 */
function log_out(){
    unset($_SESSION["email"]);
    unset($_SESSION["name"]);
    unset($_SESSION["role"]);
    unset($_SESSION['user_id']);
    unset($_SESSION['last_name']);
    header("Location: ../views/index.php");

}

/**
 * Checks user role
 * @return bool
 */
function is_admin(){
    if(!isset($_SESSION["role"]))
        return false;

    else if ($_SESSION['role']=="admin")
        return true;

    else
        return false;

}
//helper functions

/**
 * returns user id
 * @return mixed
 */
function userID(){
   return $returnStament = $_SESSION["user_id"];
}

/**
 * returns user lastname
 * @return mixed
 */

function lastname(){
    return $returnStament = $_SESSION["last_name"];
}

/**
 * returns user name
 * @return mixed
 */

function name(){
    return $returnStament = $_SESSION["name"];
}

/**
 * returns use email
 * @return mixed
 */
function email(){
    return $returnStament = $_SESSION["email"];
}

/**
 * prints and item
 * @param $item
 */
function printItem($item){
    echo $item;
}

/**
 * returns the format of the date so that it can be compared
 * @param $date
 * @return false|string
 */
function returnStandardFormat($date){
    return date_format($date,"Y-m-d");
}

/**
 * for testing this creates a break between statements
 */
function createBreak(){
    echo "<br>";
}
/**
 * prints and item and includes a break for testing purposes
 * @param $item
 */
function printItemBreak($item){
    echo $item;
    createBreak();
}

/**
 * this function returns the number of days in any past, present and future amounts, it also returns the string value of a future date
 * @param $date
 * @param $numberOfFuturePastMonths
 * @param $incrementDecrement|string|+|-
 * @param $boolean
 * @return false|int|string
 */
function calculateDaysMonth($date,$numberOfFuturePastMonths,$incrementDecrement,$boolean){

    $resultDate = date ('Y-m-d',strtotime($incrementDecrement.$numberOfFuturePastMonths." months",strtotime($date->format('Y-m-01'))));
    if($boolean){
        return cal_days_in_month(CAL_GREGORIAN,date_create($resultDate)->format("m"),date_create($resultDate)->format("Y"));
    }else{
       return $resultDate;
    }

}

/**
 * creates Date Using String With Any Day
 * @param $date
 * @param $day
 * @return string
 */
function createDateUsingStringWithAnyDay($date,$day){
    return date_create($date)->format("Y-m-".$resetDay = is_numeric($day)? $day : "Y");
}

/**
 * this function adds or subtracts days from date
 * @param $date
 * @param $numberOfFuturePastDays
 * @param $incrementDecrement
 * @return false|string
 */
function addSubDaysToDate($date,$numberOfFuturePastDays,$incrementDecrement){

    return $Date2 = date('Y-m-d', strtotime(returnStandardFormat($date). " ".$incrementDecrement." ".$numberOfFuturePastDays." days"));


}

/**
 * returns insert query string
 * @param $table string
 * @param $keyValues object
 * @return string
 */
function SQLInsert($table,$keyValues){
  return  $sql ="INSERT INTO ".$table." (".createQueryStringKeys($keyValues).") VALUES (".createQueryStringValues($keyValues).")";
}

/**
 * this function inserts and select from database, and return necessary statements
 * @param $sql
 * @param $conn
 * @param $returnType |conn, rows, result
 * @param $connectionName | this helps you identify the sql execution performed
 * @param $printHelperStatements @bool | turn on and of debug print statements
 * @return array|bool|mysqli_result|null
 */
function dataBaseManipulation($sql,$conn,$returnType,$connectionName,$printHelperStatements){

    if($result = mysqli_query($conn,$sql)){
        If($printHelperStatements){
            printItemBreak("exicution was a succes for:");
            printItemBreak($connectionName);
        }
        If($returnType === "conn"){
            return $conn;
        }else if($returnType === "rows"){
            return mysqli_fetch_assoc($result);
        }else if($returnType === "result"){
            return $result;
        }else{
            return null;
        }
    }else{
        If($printHelperStatements){
            printItemBreak("exicution was a Failure for and the following error was found:");
            printItemBreak($connectionName);
            printItemBreak(mysqli_error($conn));
            printItemBreak($sql);
        }
        return $result;
    }

}

/**
 * loads script according to the page
 * @param $script_url
 * @param $execution_page | if null the script will be loaded on all pages
 */
function scriptPageLoader($script_url, $execution_page){
    if($execution_page == NULL){
        printItem('<script src="'.$script_url.'"defer></script>');
    }else if(basename($_SERVER['PHP_SELF']) == $execution_page){
        printItem('<script src="'.$script_url.'"defer></script>');
    }

}

/**
 * loads style sheets according to the page
 * @param $style_url
 * @param $execution_page | if null the style sheet will be loaded on all pages
 */
function stylePageLoader($style_url, $execution_page){
    if($execution_page == NULL){
        printItem('<link rel="stylesheet" href="'.$style_url.'">');
    }else if(basename($_SERVER['PHP_SELF']) == $execution_page){
        printItem('<link rel="stylesheet" href="'.$style_url.'">');
    }

}
