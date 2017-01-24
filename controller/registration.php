<?php
require_once ("../inclusion/inclusion.php");
AllIncludes('security',"functions","dataB","user","preference","errorsuccess");

 if(isset($_POST)){
     $user_id;
     $message = new ErrorSuccess();

     $user = new User($_POST['firstname'],$_POST['lastname'],$_POST['email'],Security::encrypt($_POST['password'], returnKey()),$_POST['gender']);

     //check password length
     if(strlen($_POST['password']) < 4){
         $message->addTOErrorArray("Your password has to be longer than 4 characters",12);
     }
     if(strlen($user->firstname) < 4){
         $message->addTOErrorArray("Your name has to be longer than 4 characters",12);
     }
     if(strlen($user->last_name) < 4){
         $message->addTOErrorArray("Your last name has to be longer than 4 characters",12);
     }
     if(strcasecmp($_POST['password'],$_POST["confirmPassword"]) !=0){
         $message->addTOErrorArray("Your passwords are not equal",12);
     }

     if($message->getError()){
         $message->addError();
         header("Location: ../views/registrationView.php");
         exit();
     }


     $sql  = "INSERT INTO `user` (".createQueryStringKeys($user).") VALUES (".createQueryStringValues($user).")";
     //echo $sql1;
      echo $sql;

     $conn = con();
     if (mysqli_query($conn,$sql)) {
         echo "New record created successfully";
         $user_id = mysqli_insert_id($conn);
         $pref = new Preference(null,$user_id);
         unsetProperties($pref,"currency_id");
         dataBaseManipulation(SQLInsert("preference",$pref),con(),"result","pref insert",true);
         $message->addToSuccessArray("You have been registered",12);
         $message->addSuccess();
         header("Location: ../views/loginView.php");


     } else {
         echo "Error: " . $sql . "<br>" . mysqli_error(con());
         $message->addTOErrorArray("this email exists",12);
         $message->addError();
         unset($_SESSION["success"]);
         header("Location: ../views/registrationView.php");
     }

     mysqli_close(con());


 }

