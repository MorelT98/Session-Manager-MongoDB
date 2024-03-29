<?php
    session_start();
    // Generate a random number
    $random_number = rand();

    // Put the number into a session
    $_SESSION['random_number'] = $random_number;
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Understanding PHP sessions...Page 1</title>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea">
                <h2>Understanding PHP sessions...Page 1</h2>
                <p>Random number generated
                    <span style="font-weight:bold;">
                        <?php echo $_SESSION['random_number']; ?>
                    </span>
                </p>
                <p>PHP session id
                    <span style="text-decoration:underline;">
                        <?php echo session_id(); ?>
                    </span>
                </p>
                <a href="basic_session2.php">Go to next page</a>
            </div>
        </div>
    </body>
</html> 