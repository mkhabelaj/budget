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
