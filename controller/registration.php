<?php
require_once ("../inclusion/inclusion.php");
AllIncludes('security',"functions","dataB","user");

 if(isset($_POST)){

     $user = new User($_POST['firstname'],$_POST['lastname'],$_POST['email'],Security::encrypt($_POST['password'], returnKey()),$_POST['gender']);

     $sql  = "INSERT INTO `user` (".createQueryStringKeys($user).") VALUES (".createQueryStringValues($user).")";
     //echo $sql1;
      echo $sql;

     //$result = mysqli_query($con,$sql);
     if (mysqli_query(con(),$sql)) {
         echo "New record created successfully";
         header("Location: ../views/index.php");

     } else {
         echo "Error: " . $sql . "<br>" . mysqli_error(con());
         header("Location: ../views/registrationView.php");
         $_SESSION["error"] = "this email exists";
     }

     mysqli_close(con());


 }


