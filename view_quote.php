<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            View A Quotation
        </title>
    </head>
    <body>
        <h1>
            Random Quotation
        </h1>
        <?php
            // define & initialize file content
            $data = file("../../quotes.txt");

            // define & initialize file item count
            $n = count($data);

            // define & initialize random item from file
            $rand = rand(0, ($n - 1));

            // print the random quotation
            print "<p>" . trim($data[$rand]) . "</p>";
        ?>
    </body>
</html>