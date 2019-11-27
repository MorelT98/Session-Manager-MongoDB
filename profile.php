<?php
    require 'session.php';
    require 'user.php';
    $user = new User();
    if(!$user->isLoggedIn()) {
        header('location: login.php');
        exit;
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css"/>
        <title>Welcome <?php echo $user->username; ?></title>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <a style="float:right;" href="logout.php">Log out</a>
                <h1>Hello <?php echo $user->username; ?></h1>
                <ul class="profile-list">
                    <li>
                        <span class="field">Username</span>
                        <span class="value">
                            <?php echo $user->username; ?>
                        </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="field">Name</span>
                        <span class="value">
                            <?php echo $user->name; ?>
                        </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="field">Birthday</span>
                        <span class="value">
                            <?php echo $user->birthday->toDateTime()->format('j F Y'); ?>
                        </span>
                        <div class="clear"></div>
                    </li>
                    <li>
                        <span class="field">Address</span>
                        <span class="value">
                            <?php echo $user->address; ?>
                        </span>
                        <div class="clear"></div>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>