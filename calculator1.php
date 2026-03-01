<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Cost Calculator
        </title>
    </head>
    <body>
        <?php
            // calculate total function with 2 args
            function calculate_total($quantity, $price)
            {
                // calculate total
                $total = $quantity * $price;

                // format total
                $total = number_format($total, 2);

                // return total
                return $total;
            }

            //determine if form has been submitted yet
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // determine if quantity & price have been collected
                if (is_numeric($_POST["quantity"]) && is_numeric($_POST["price"]))
                {
                    // call calculate_total function
                    $total = calculate_total($_POST["quantity"], $_POST["price"]);

                    // print results
                    print "<p>Your total comes out to $<span style=\"font-weight: bold;\">$total</span>.</p>";
                }
                else
                {
                    // print error message
                    print "<p style='color: red;'>Please enter a valid quantity & price!</p>";
                }
            }
        ?>

        <!-- create form -->
        <form action="" method="post">
            <p>
                Quantity: <input type="text" name="quantity" size="3">
            </p>
            <p>
                Price: <input type="text" name="price" size="5">
            </p>
            <input type="submit" name="submit" value="Calculate!">
        </form>
    </body>
</html>