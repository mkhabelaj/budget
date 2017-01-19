<?php

    //include('../templates/headerView.php');
    //require_once ('../functions/functions.php');
require_once ('../inclusion/inclusion.php');
AllIncludes('header',"functions");


    if(isset($_SESSION['error'])){
        echo $_SESSION['email'];
        //echo $_SESSION['error'];
        unset($_SESSION['error']);
    }

?>
<div class="row">
    <div class="colm-12">
        <div class="form-container">
            <form action="../controller/registration.php" method="post" id="form">
                <label for="form" class="form-header">Register</label>
                <input type="text" name="firstname" placeholder="Name" id="firstname" required>
                <input type="text" name="lastname" placeholder="Lastname" id="lastname" required>
                <input type="email" name="email" placeholder="Email" id="email" required>
                <select name="gender" id="gender" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <input type="password" name="password" placeholder="Password" id="password" required>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
                <input type="submit" id="submit">
            </form>

        </div>
    </div>

</div>

<?php factory()->getInclusion('footer')->Inclusion();?>