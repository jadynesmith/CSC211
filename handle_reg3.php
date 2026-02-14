<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Registration
        </title>
        <style type="text/css" media="screen">
            .error { color: red; }
        </style>
    </head>
    <body>
        <h1>
            Registration Results
        </h1>

        <?php
            // enable display errors
            ini_set("display_errors", 1);

            // set error reporting to highest level
            error_reporting(E_ALL);

            // declare & initialize correct flag
            $correct = true;

            // validate email address
            if (empty($_POST["email"]))
            {
                // print error message
                print "<p class='error'>Please enter your email address.</p>";

                // flag error
                $correct = false;
            }

            // validate password
            if (empty($_POST["password"]))
            {
                // print error message
                print "<p class='error'>Please enter your password.</p>";

                // flag error
                $correct = false;
            }

            // validate birth year
            if (is_numeric($_POST["year"]))
            {
                // calculate age this year
                $age = 2026 - $_POST["year"];
            }
            else
            {
                // print error message
                print "<p class='error'>Please enter the year you were born as four digits.</p>";

                // flag error
                $correct = false;
            }

            // check if flag signals correct form submission & print success message if so
            if ($correct)
            {
                print "<p>You have been successfully registered (but not really).</p>";
                print "<p>You will turn $age this year.</p>";
            }
        ?>
    </body>
</html>