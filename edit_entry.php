<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Edit a Blog Entry
        </title>
    </head>
    <body>
        <h1>
            Edit an Entry
        </h1>

        <?php
            // connect to database
            $dbc = @mysqli_connect("localhost", "root", "MyCSC211!", "myblog");

            // call method to set character set
            mysqli_set_charset($dbc, "utf8");

            // determine if id is valid for get
            if (isset($_GET["id"]) && is_numeric($_GET["id"]))
            {
                // define & initialize query
                $query = "SELECT title, entry FROM entries WHERE id={$_GET['id']}";

                // attempt query execution
                if ($r = mysqli_query($dbc, $query))
                {
                    // define & initialize row
                    $row = mysqli_fetch_array($r);

                    // print edit form
                    print   "<form action='edit_entry.php' method='post'>
                                <p>Entry Title: <input type='text' name='title' size='40' maxsize='100' value='" . htmlentities($row["title"]) . "'></p>
                                <p>Entry Text: <textarea name='entry' cols='40' rows='5'>" . htmlentities($row["entry"]) . "</textarea></p>
                                <input type='hidden' name='id' value='" . $_GET["id"] . "'>
                                <input type='submit' name='submit' value='Update this Entry!'>
                            </form>";
                }
                else
                {
                    // print error message
                    print   "<p style='color: red;'>Could not retrieve the blog entry because:<br>" . 
                            mysqli_error($dbc) . ".</p><p>This query being run was: " . $query . "</p>";
                }
            }
            // determine if id is valid for post
            elseif (isset($_POST["id"]) && is_numeric($_POST["id"]))
            {
                // define & initilize flag
                $problem = FALSE;

                // determine if fields are completed
                if (!empty($_POST["title"]) && !empty($_POST["entry"]))
                {
                    // trim, strip tags, & secure fields
                    $title = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["title"])));
                    $entry = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["entry"])));
                }
                else
                {
                    // print error message
                    print "<p style='color: red;'>Please submit both a title and an entry.</p>";

                    // update flag
                    $problem = TRUE;
                }

                if (!$problem)
                {
                    // define & initialize query
                    $query = "UPDATE entries SET title='$title', entry='$entry' WHERE id={$_POST['id']}";

                    // execute query
                    $r = mysqli_query($dbc, $query);

                    // determine if edited
                    if (mysqli_affected_rows($dbc) == 1)
                    {
                        // print updated message
                        print "<p>The blog entry has been updated.</p>";
                    }
                    else
                    {
                        // print error message
                        print   "<p style='color: red;'>Could not update the entry because:<br>" . 
                                mysqli_error($dbc) . ".</p><p>The query being run was: " . $query . "</p>";
                    }
                }
            }
            else
            {
                // print error message
                print "<p style='color: red;'>This page has been accessed in error.</p>";
            }

            // disconnect from database
            mysqli_close($dbc);
        ?>
    </body>
</html>