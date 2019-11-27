<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style.css" />
        <title>Understanding PHP sessions...Page 2</title>
    </head>
    <body>
        <div id="contentarea">
            <div id="innercontentarea"/>
                <h2>Understanding PHP sessions...Page 2</h2>
                <p>My Favorite movie is
                    <span style="font-weight:bold;">
                        <?php echo $_SESSION['random_number']; ?>
                    </span>
                </p>
                <p>PHP session id
                    <span style="text-decoration:underline;">
                            <?php echo session_id(); ?>
                    </span>
                </p>
            </div>
        </div>
    </body>
</html>
