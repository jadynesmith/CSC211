<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Larry Ullman's Books
        </title>
    </head>
    <body>
        <h1>
            Some of Larry Ullman's Books
        </h1>

        <?php
            // enable display errors
            ini_set("display_errors", 1);

            // set error reporting to highest level
            error_reporting(E_ALL);

            // define & initialize first array
            $phpvqs = 
            [
                1 =>    "Getting Started with PHP",
                        "Variables",
                        "HTML Forms and PHP",
                        "Using Numbers"
            ];

            // define & initialize second array
            $phpadv = 
            [
                1 =>    "Advanced PHP Techniques",
                        "Developing Web Applications",
                        "Advanced Database Concepts",
                        "Basic Object-Oriented Programming"
            ];

            // define & initialize third array
            $phpmysql = 
            [
                1 =>    "Introduction to PHP",
                        "Programming with PHP",
                        "Creating Dynamic Web Sites",
                        "Introduction to MySQL"
            ];

            // define & initialize multi-dimensional array
            $books = 
            [
                "PHP VQS"           => $phpvqs,
                "PHP Advanced VQP"  => $phpadv,
                "PHP and MySQL VQP" => $phpmysql
            ];

            // print test values
            print "<p>The third chapter of my first book is <i>{$books['PHP VQS'][3]}</i>.</p>";
            print "<p>The first chapter of my second book is <i>{$books['PHP Advanced VQP'][1]}</i>.</p>";
            print "<p>The fourth chapter of my fourth book is <i>{$books['PHP and MySQL VQP'][4]}</i>.</p>";

            // test foreach loop
            foreach ($books as $key => $value)
            {
                // print key value pair
                print "<p>$key: $value</p>\n";
            }
        ?>
    </body>
</html>