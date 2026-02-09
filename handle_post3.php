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

            // concatenate full name variable
            $full_name = $first_name . ' ' . $last_name;

            // define, initialize, & adjust HTML tag output variables
            $posting = nl2br($_POST['posting'], false);
            $html_post = nl2br(htmlentities($_POST['posting']));
            $strip_post = nl2br(strip_tags($_POST['posting']));

            // print post verification message
            print " <div>Thank you, $full_name, for your posting:
                    <p>Original: $posting</p>
                    <p>Entity: $html_post</p>
                    <p>Stripped: $strip_post</p></div>";
        ?>
    </body>
</html>