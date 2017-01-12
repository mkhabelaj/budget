<?php
require_once ("../inclusion/inclusion.php");
AllIncludes('security',"functions","dataB","user","preference");

 if(isset($_POST)){
     $user_id;

     $user = new User($_POST['firstname'],$_POST['lastname'],$_POST['email'],Security::encrypt($_POST['password'], returnKey()),$_POST['gender']);

     $sql  = "INSERT INTO `user` (".createQueryStringKeys($user).") VALUES (".createQueryStringValues($user).")";
     //echo $sql1;
      echo $sql;

     $conn = con();
     if (mysqli_query($conn,$sql)) {
         echo "New record created successfully";
         $user_id = mysqli_insert_id($conn);
         $pref = new Preference(null,$user_id);
         unsetProperties($pref,"currency_id");
         dataBaseManipulation(SQLInsert("preference",$pref),con(),"pref insert",false);
         header("Location: ../views/index.php");


     } else {
         echo "Error: " . $sql . "<br>" . mysqli_error(con());
         header("Location: ../views/registrationView.php");
         $_SESSION["error"] = "this email exists";
     }

     mysqli_close(con());




 }


