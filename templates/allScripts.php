<?php
/**
 * Created by PhpStorm.
 * User: JacksonM
 * Date: 2016-12-28
 * Time: 09:59 AM
 */

scriptPageLoader("https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js",null);
scriptPageLoader("../js/script.js",null);
scriptPageLoader("../js/modal.js",null);
scriptPageLoader("../js/notificationCenter.js",null);
scriptPageLoader("../js/friendSearch.js",null);
scriptPageLoader("../js/addFriendToBudget.js","budget.php");
scriptPageLoader("../js/createBudget.js","createBudget.php");
scriptPageLoader("https://code.jquery.com/ui/1.12.1/jquery-ui.js","createBudget.php");
scriptPageLoader("../js/budgetView.js","budgetView.php");
scriptPageLoader("../js/registration.js","registrationView.php");