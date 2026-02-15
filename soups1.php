<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            No Soup for You!
        </title>
    </head>
    <body>
        <h1>
            Mmm... soups
        </h1>

        <?php
            // enable display errors
            ini_set("display_errors", 1);

            // set error reporting to highest level
            error_reporting(E_ALL);
            
            // define & initialize array
            $soups =
            [
                "Monday"    => "Clam Chowder",
                "Tuesday"   => "White Chicken Chili",
                "Wednesday" => "Vegetarian",
                "Thursday"  => "Chicken Noodle",
                "Friday"    => "Wedding",
                "Saturday"  => "Beef Stew",
                "Sunday"    => "Ramen"
            ];

            // attempt to print array
            print "<p>$soups</p>";

            // print contents of array
            print_r($soups);
        ?>
    </body>
</html>