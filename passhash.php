<!doctype html>
<html lang="en">
    <head>
        <meta charset="etf-8">
        <title>
            Password Hashing
        </title>
    </head>
    <body>
        <?php
            // define & initialize password variable
            $password = "helloclass";

            // hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // display the hashed password
            echo $hashed_password;
        ?>
    </body>
</html>