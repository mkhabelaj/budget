<?php
require_once ('../inclusion/inclusion.php');
factory()->getInclusion('functions')->Inclusion();
?>
<!DOCTYPE HTML>
<HTML>
<head>
    <title>
        Budget
    </title>
    <link rel="stylesheet" type="text/css" href="../style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
    <nav>
        <a href="../views/index.php">Home</a> |
        <?php if(is_logged_in()):?>
            <a href="../views/profileView.php"><?php echo $_SESSION["name"];?></a>
            <a href="../views/budget.php">budget</a>|
            <a href="../controller/logOut.php">Sign out</a>|
                <?php if(is_admin()):?>
                <a href="../views/adminView.php">Administration</a>|
                <?php endif;?>
            <a href="../views/notificationView.php">
                <div style="display: inline"> <!--CSS-->
                    Notifications
                    (<div class="notification" style="display: inline"></div>)<!--CSS-->
                </div>
            </a>|
            <?php else: ?>
            <a href="../views/registrationView.php">Register</a>|
            <a href="../views/loginView.php">Sign in</a>|
        <?php endif;?>
    </nav>
<br>

