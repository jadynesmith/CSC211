<!doctype html>
<html lang="en">
    <head>
        <meta charset="etf-8">
        <title>
            String Manipulation
        </title>
    </head>
    <body>
        <?php
            // define & initialize variables
            $break = "<br>";
            $string = "Jadyn Smith";

            // demonstrate substr() function: returns a substring from a string
            echo("<strong>substr() Function:</strong>");
            echo($break);
            echo "'" . substr($string, 2, 3) . "' from '$string'";
            echo($break);
            echo($break);

            // demonstrate strlen() function: returns the length of a string in letters
            echo("<strong>strlen() Function:</strong>");
            echo($break);
            echo strlen($string);
            echo($break);
            echo($break);

            // demonstrate str_word_count() function: returns the word count of a string
            echo("<strong>str_word_count() Function:</strong>");
            echo($break);
            echo str_word_count($string);
            echo($break);
            echo($break);
        ?>
    </body>
</html>