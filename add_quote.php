<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Add A Quotation</title>
    </head>
    <body>
        <?php
            // define & initialize file
            $file = "../../quotes.txt";

            // determine if form has been submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // determine if quote has been completed
                if (!empty($_POST["quote"]) && ($_POST["quote"] != "Enter your quotation here."))
                {
                    // determine if file is writable
                    if (is_writable($file))
                    {
                        // add quotes to file
                        file_put_contents($file, $_POST["quote"] . PHP_EOL, FILE_APPEND);

                        // print quote storage confirmation message
                        print "<p>Your quotation has been stored.</p>";
                    }
                    else
                    {
                        // print error message
                        print "<p style='color: red;'>Your quotation could not be stored due to a system error.</p>";
                    }
                }
                else
                {
                    // print error message
                    print "<p style='color: red;'>Please enter a quotation first!</p>";
                }
            }
        ?>
        <!-- display form -->
        <form action="add_quote.php" method="post">
            <textarea name="quote" rows="5" cols="30">Enter your quotation here.</textarea><br>
            <input type="submit" name="submit" value="Add This Quote!">
        </form>
    </body>
</html>