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

    <?php
    require_once ('../templates/allStyles.php');
    require_once ('../templates/allScripts.php');
    ?>
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
            <a href="../views/notificationView.php" id="open-modal-notification" class="open-modal">

                <div style="display: inline"> <!--CSS-->
                    Notifications
                    (<div class="notification" style="display: inline"></div>)<!--CSS-->
                </div>
            </a>|
            <a href="../views/settingsView.php" >Settings</a>|
            <a href="../views/notificationView.php" id="open-modal-friend-search" class="open-modal">Friends</a>|
            <?php else: ?>
            <a href="../views/registrationView.php">Register</a>|
            <a href="../views/loginView.php">Sign in</a>|
        <?php endif;?>
    </nav>
<br>

