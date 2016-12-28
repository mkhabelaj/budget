<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-25
 * Time: 01:45 PM
 */

require_once ("../inclusion/inclusion.php");
AllIncludes('security',"functions","dataB");
if(isset($_POST)){
    //echo Security::encrypt($_POST["password"],$key);

    $sql = "SELECT * FROM user WHERE email=".createQueryStringForVariable($_POST["email"])."AND password=".createQueryStringForVariable(Security::encrypt($_POST["password"],returnKey()));

    echo $sql;
    $result = mysqli_query(con(),$sql);
    if(mysqli_num_rows($result) > 0){
		    while($row = mysqli_fetch_assoc($result)){
                echo $row["firstname"]." <br>".$row["email"];
                $_SESSION['name']=$row["firstname"];
                $_SESSION['last_name'] =$row['last_name'];
                $_SESSION['email']=$row["email"];
                $_SESSION['role']= $row["role"];
                $_SESSION['user_id'] = $row['user_id'];
            }
        header("Location: ../views/index.php");



	  }else{
        echo "0 results";
        $_SESSION['error']='your credentials are incorrect';
        header("Location: ../views/loginView.php");
    }
}else{
    echo 'post is not set';
}
