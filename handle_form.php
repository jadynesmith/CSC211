<!doctype html>
<html lang="en">
    <head>
        <meta charset="uft-8">
        <title>
            Your Feedback
        </title>
    </head>
    <body>
        <?php
            // receives title, first_name, last_name, response, & comments from feedback2.html in $_POST

            // displays error messages on website
            ini_set('display_errors', 1);

            // declaration of shorthand variables
            $title = $_POST['title'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $response = $_POST['response'];
            $comments = $_POST['comments'];
            
            // returns message to user
            print " <p>Thank you, $title $first_name $last_name, for your comments.</p>
                    <p>You stated that you found this example to be '$response' and added:
                    <br>$comments</p>";
        ?>
    </body>
</html>