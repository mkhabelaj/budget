 <?php
    require_once ("../inclusion/inclusion.php");
    AllIncludes('header',"functions");

    if(isset($_SESSION['email'])&&isset($_SESSION["user_id"])){
        if(isset($_SESSION["error"])){
            unset($_SESSION["error"]);
        }
    }

     ?>


 <div class="articles row override-row-articles">

 <?php


 factory()->getInclusion("footer")->Inclusion();
