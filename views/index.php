 <?php
    require_once ("../inclusion/inclusion.php");
    factory()->getInclusion("header")->Inclusion();
    factory()->getInclusion("functions")->Inclusion();

     //require('../functions/functions.php');
//     include('../templates/Security.php');
//     $value = "example";
//     $key = "0828811537082881"; //16 Character Key
//     echo Security::encrypt($value, $key);
//     echo Security::decrypt(Security::encrypt($value, $key), $key);
     echo 'Aloha <br>';
    if(isset($_SESSION['name'])){
        echo $_SESSION['name'];
    }
    var_dump($_SESSION);

 factory()->getInclusion("footer")->Inclusion();

