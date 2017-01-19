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
AllIncludes('header',"functions");

?>
<div class="row">
    <div class="colm-12">
        <div class="form-container">
            <form id="login-form" method="post" action="../controller/login.php">
                <label class="form-header" for="login-form">Login</label>
                <input name="email" type="email" placeholder="Email" id="email" required>
                <input name="password" type="password" placeholder="Password" id="password" required>
                <input type="submit"  required>
            </form>
        </div>
    </div>
</div>



<?php
factory()->getInclusion("footer")->Inclusion();
?>