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

            // validate password equality
            if ($_POST["password"] != $_POST["confirm"])
            {
                // print error message
                print "<p class='error'>Your confirmed password does not match the original password.</p>";

                // flag error
                $correct = false;
            }

            // validate birth year
            if (is_numeric($_POST["year"]) AND (strlen($_POST["year"]) == 4))
            {
                // validate birth year before current year
                if ($_POST["year"] < 2026)
                {
                    // calculate age this year
                    $age = 2026 - $_POST["year"];
                }
                else
                {
                    // print error message
                    print "<p class='error'>Either you entered your birth year wrong or you came from the future!</p>";

                    // flag error
                    $correct = false;
                }
            }
            else
            {
                // print error message
                print "<p class='error'>Please enter the year you were born as four digits.</p>";

                // flag error
                $correct = false;
            }

            // validate terms
            if (!isset($_POST["terms"]))
            {
                // print error message
                print "<p class='error'>You must accept the terms.</p>";

                // flag error
                $correct = false;
            }

            // validate color
            if ($_POST["color"] == "red")
            {
                // set color type
                $color_type = "primary";
            }
            elseif ($_POST["color"] == "yellow")
            {
                // set color type
                $color_type = "primary";
            }
            elseif ($_POST["color"] == "green")
            {
                // set color type
                $color_type = "secondary";
            }
            elseif ($_POST["color"] == "blue")
            {
                // set color type
                $color_type = "primary";
            }
            elseif ($_POST["color"] == "pink")
            {
                // set color type
                $color_type = "secondary";
            }
            elseif ($_POST["color"] == "orange")
            {
                // set color type
                $color_type = "secondary";
            }
            else
            {
                // print error message
                print "<p class='error'>Please select your favorite color.</p>";

                // flag error
                $correct = false;
            }

            // check if flag signals correct form submission & print success message if so
            if ($correct)
            {
                print "<p>You have been successfully registered (but not really).</p>";
                print "<p>You will turn $age this year.</p>";
                print "<p>Your favorite color is a $color_type color.</p>";
            }
        ?>
    </body>
</html>