<?php
    require_once 'session.php';
?>

<html>
    <head>
        <title>Using the SessionManager...Page 2</title>
        <link rel="stylesheet" href="style.css"/>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <h2>Using the SessionManager...Page 2</h2>
                <p>The number generated is still 
                    <span style="font-weight:bold;">
                        <?php echo $_SESSION['random_number']; ?>
                    </span>
                </p>
            </div>
        </div>
    </body>
</html>
