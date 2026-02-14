<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Registration
        </title>
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

            // check if flag signals correct form submission & print success message if so
            if ($correct)
            {
                print "<p>You have been successfully registered (but not really).</p>";
            }
        ?>
    </body>
</html>