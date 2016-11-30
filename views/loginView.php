<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-11-25
 * Time: 09:11 AM
 */
    //include ("../templates/headerView.php");
   // require_once ("../functions/functions.php");
require_once ("../inclusion/inclusion.php");
factory()->getInclusion("header")->Inclusion();
factory()->getInclusion('functions')->Inclusion();

?>
<h2>Login</h2>

<form method="post" action="../controller/login.php">
    <label for="email">Email: </label>
    <input name="email" type="email" placeholder="Email" id="email" required>
    <label for="password">Password</label>
    <input name="password" type="password" placeholder="Password" id="password" required>
    <input type="submit"  required>
</form>

<?php
factory()->getInclusion("footer")->Inclusion();
?>