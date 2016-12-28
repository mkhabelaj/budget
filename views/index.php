 <?php
    require_once ("../inclusion/inclusion.php");
    AllIncludes('header',"functions");

     echo 'Aloha <br>';
    if(isset($_SESSION['email'])&&isset($_SESSION["user_id"])){
        if(isset($_SESSION["error"])){
            unset($_SESSION["error"]);
        }
    }
    var_dump($_SESSION);

 factory()->getInclusion("footer")->Inclusion();

