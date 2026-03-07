<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Connect to MySQL
        </title>
    </head>
    <body>
        <?php
            // attempt database connection
            if ($dbc = @mysqli_connect("localhost", "root", "MyCSC211!", "myblog"))
            {
                // print success message
                print "<p>Successfully connected to the database!</p>";

                // close database connection
                mysqli_close($dbc);
            }
            else
            {
                // print error message
                print "<p style='color: red;'>Could not connect to the database:<br>" . mysqli_connect_error() . ".</p>";
            }
        ?>
    </body>
</html>