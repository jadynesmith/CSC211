<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Variables
        </title>
    </head>
    <body>
        <?php
            // name details
            $first_name = "Jadyn";
            $last_name = "Smith";

            // address details
            $street = "1234 North Example Street";
            $unit = "A1";
            $city = "Example City";
            $state = "AZ";
            $zip = 98765;

            // phone number details
            $area_code = 123;
            $phone_number = "456-7890";

            // print statements
            print "<p><b>My name is:</b><br>$first_name $last_name</p>";
            print "<p><b>My address is:</b><br>$street, Unit #$unit<br>$city, $state $zip</p>";
            print "<p><b>My phone number is:</b><br>($area_code) $phone_number";
        ?>
    </body>
</html>