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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
    <nav>
        <a href="../views/index.php">Home</a> |
        <?php if(is_logged_in()):?>
            <a href="../views/budget.php">budget</a>|
            <a href="../controller/logOut.php">Sign out</a>|
                <?php if(is_admin()):?>
                <a href="../views/adminView.php">Administration</a>|
                <?php endif;?>
            <?php else: ?>
            <a href="../views/registrationView.php">Register</a>|
            <a href="../views/loginView.php">Sign in</a>|
        <?php endif;?>
    </nav>
<br>

