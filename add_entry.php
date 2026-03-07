<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Add a Blog Entry
        </title>
    </head>
    <body>
        <h1>
            Add a Blog Entry
        </h1>

        <?php
            // determine if form has already been completed
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // define & initialize flag
                $problem = FALSE;

                // determine if form items have been completed
                if (!empty($_POST["title"]) && !empty($_POST["entry"]))
                {
                    // trim & string tage from form items
                    $title = trim(strip_tags($_POST["title"]));
                    $entry = trim(strip_tags($_POST["entry"]));
                }
                else
                {
                    // print error message
                    print "<p style='color:red;'>Please submit both a title & an entry.</p>";

                    // update flag
                    $problem = TRUE;
                }

                // determine if no flags have been raised
                if (!$problem)
                {
                    // connect to database
                    $dbc = @mysqli_connect("localhost", "root", "MyCSC211!", "myblog");

                    // deing & initialize query
                    $query =    "INSERT INTO 
                                entries (id, title, entry, date_entered) 
                                VALUES (0, '$title', '$entry', NOW())";

                    // attempt query execution
                    if (@mysqli_query($dbc, $query))
                    {
                        // print entry added message
                        print "<p>The blog entry has been added!</p>";
                    }
                    else
                    {
                        // print error message
                        print "<p style='color: red;'>Could not add the entry because:<br>" . mysqli_error($dbc) . ".</p><p>The questy being run was: " . $query . "</p>";
                    }

                    // close databse connection
                    mysqli_close($dbc);
                }
            }
        ?>

        <!-- display the form -->
        <form action="add_entry.php" method="post">
            <p>
                Entry Title: <input type="text" name="title" size="40" maxsize="100">
            </p>
            <p>
                Entry Text: <textarea name="entry" cols="40" rows="5"></textarea>
            </p>
            <input type="submit" name="submit" value="Post This Entry!">
        </form>
    </body>
</html>