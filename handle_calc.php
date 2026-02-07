<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Product Cost Calculator</title>
        <style type="text/css">
            .number { font-weight: bold; }
        </style>
    </head>
    <body>
        <?php
            // get values from $_POST array & assign them to variables
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $discount = $_POST['discount'];
            $tax = $_POST['tax'];
            $shipping = $_POST['shipping'];
            $payments = $_POST['payments'];

            // calculate total
            $total = $price * $quantity;
            $total = $total + $shipping;
            $total = $total - $discount;

            // determine & factor in tax rate
            $taxrate = $tax / 100;
            $taxrate = $taxrate + 1;
            $total = $total * $taxrate;

            // calculate monthly payments
            $monthly = $total / $payments;

            // print results
            print " <p>You Have Selected To Purchase:<br>
                    <span class=\"number\">$quantity</span> Widget(s) At 
                    $<span class=\"number\">$price</span> Each With A 
                    $<span class=\"number\">$shipping</span> Shipping Cost & A 
                    <span class=\"number\">$tax</span>% Tax Rate.<br>After your 
                    $<span class=\"number\">$discount</span> Discount, The Total Cost Is
                    $<span class=\"number\">$total</span>.<br> Divided Over 
                    <span class=\"number\">$payments</span> Monthly Payments, That Would be 
                    $<span class=\"number\">$monthly</span> Each.</p>";
        ?>
    </body>
</html>