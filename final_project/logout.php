<!doctype html>
<html lang="en">
    <meta charset="utf-8">
    <title>
        Log Out
    </title>
    <body>
        <?php
            // start session
            session_start();

            // destroy session
            session_unset();
            session_destroy();

            // redirect to login page
            header("Location: login.php");

            // exit script
            exit();
        ?>
    </body>
</html>