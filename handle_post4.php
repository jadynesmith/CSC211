<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Forum Posting
        </title>
    </head>
    <body>
        <?php
            // define & initialize variables via $_POST array
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $posting = nl2br($_POST['posting'], false);

            // concatenate full name variable
            $full_name = $first_name . ' ' . $last_name;

            // print post verification message
            print " <div>Thank you, $full_name, for your posting:
                    <p>$posting</p></div>";

            // encode variables for link
            $full_name = urlencode($full_name);
            $email = urlencode($_POST['email']);

            // print next step link
            print "<p>Click <a href=\"thanks.php?name=$full_name&email=$email\">here</a> to continue.</p>";
        ?>
    </body>
</html>