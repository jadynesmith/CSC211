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
                "Wednesday" => "Vegetarian"
            ];

            // count array length
            $original_count = count($soups);

            // print array length
            print "<p>The soups array originally had $original_count elements.</p>";

            // append four (4) items to array
            $soups["Thursday"]  = "Chicken Noodle";
            $soups["Friday"]    = "Tomato";
            $soups["Saturday"]  = "Cream of Broccoli";
            $soups["Sunday"]    = "Wedding";

            // count array length
            $second_count = count($soups);

            // print array length
            print "<p>After adding 4 more soups, the array now has $second_count elements.</p>";

            // attempt to print array
            print "<p>$soups</p>";

            // print contents of array
            print_r($soups);
        ?>
    </body>
</html>