<?php
require_once ('../inclusion/inclusion.php');
AllIncludes('functions');

?>
<!DOCTYPE HTML>
<HTML>
<head>
    <title>
        Budget
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once ('../templates/allStyles.php');
    require_once ('../templates/allScripts.php');
    ?>
</head>
<body>
    <nav class="nav mobile">
        <li class="icon">
            <a href="#" class="icon-link">&#9776;</a>
        </li>
        <li>
            <a href="../views/index.php">Home</a>
        </li>
        <?php if(is_logged_in()):?>
<!--            <li>-->
<!--                <a href="../views/profileView.php">--><?php //echo ucfirst( $_SESSION["name"]);?><!--</a>-->
<!--            </li>-->
            <li>
                <a href="../views/budget.php">Budget</a>
            </li>
                <?php if(is_admin()):?>
                    <li>
                        <a href="../views/adminView.php">Administration</a>
                    </li>
                <?php endif;?>
                    <li>
                        <a href="../views/notificationView.php" id="open-modal-notification" class="open-modal">

                            <div >
                                Notifications
                                (<div class="notification" style="display: inline"></div>)
                            </div>
                        </a>
                    </li>
            <li>
                <a href="../views/notificationView.php" id="open-modal-friend-search" class="open-modal">Friends</a>
            </li>
            <li class="add-left-menu-item">
                <a href="../controller/logOut.php">Sign out</a>
            </li>
            <li class="add-left-menu-item">
                <a href="../views/settingsView.php" >Settings</a>
            </li>
            <?php else: ?>
            <li class="add-left-menu-item">
                <a href="../views/loginView.php">Sign in</a>
            </li>
            <li class="add-left-menu-item">
                <a href="../views/registrationView.php">Register</a>
            </li>

        <?php endif;?>
    </nav>
<?php if(basename($_SERVER['PHP_SELF'])==='index.php'):?>
    <div class="underlay under">
        <div class="compansate">
            <img class="img-responesiveness" src="../img/frontImage2.png">
        </div>
        <h1 class="overlay logo">EVSBudget</h1>
    </div>
<?php endif;?>
<div class="container container-style<?php printItem($class = basename($_SERVER['PHP_SELF'])==='index.php' ?'':' compansate')?>">
    <div id="central-error" class="row">
            <?php
                if(isset($_SESSION['error'])){
                    foreach ($_SESSION['error'] AS $error):
                        printItem($error);
                        endforeach;
                }
                unset($_SESSION['error']);
            ?>
    </div>
    <div id="central-success" class="row">
        <?php
        if(isset($_SESSION['success'])){
            foreach ($_SESSION['success'] AS $success):
                printItem($success);
            endforeach;
        }
        unset($_SESSION['success']);
        ?>
    </div>


