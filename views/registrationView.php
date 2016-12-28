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
<form action="../controller/registration.php" method="post" id="form">
    <label for="firstname">Name</label>
    <input type="text" name="firstname" placeholder="Name" id="firstname" required>

    <label for="lastname">Lastname</label>
    <input type="text" name="lastname" placeholder="Lastname" id="lastname" required>

    <label for="email">Email</label>
    <input type="email" name="email" placeholder="Email" id="email" required>

    <label for="gender">Gender </label>
    <select name="gender" id="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
    </select>

    <label for="password">Password</label>
    <input type="password" name="password" placeholder="Password" id="password" required>
    <label for="confirmPassword">Confirm Password</label>
    <input type="password" name="confirmPassword" id="confirmPassword" required>

    <label for="submit">Submit</label>
    <input type="submit" id="submit">
</form>
<?php factory()->getInclusion('footer')->Inclusion();?>