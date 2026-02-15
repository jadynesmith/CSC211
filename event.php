<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Add an Event
        </title>
    </head>
    <body>
        <?php
            // enable display errors
            ini_set("display_errors", 1);

            // set error reporting to highest level
            error_reporting(E_ALL);

            // print text
            print "<p>You want to add an event called <b>{$_POST['name']}</b> which takes on: <br>";

            // determine if days array is set and is an array
            if (isset($_POST['days']) AND is_array($_POST['days']))
            {
                // iterate through days array
                foreach ($_POST['days'] as $day)
                {
                    // print each day
                    print "$day<br>\n";
                }
            }
            else
            {
                print "Please select at least one weekday for this event!";
            }

            // finish paragraph
            print "</p>";
        ?>
    </body>
</html>