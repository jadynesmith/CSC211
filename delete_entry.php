<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Delete a Blog Entry
        </title>
    </head>
    <body>
        <h1>
            Delete an Entry
        </h1>

        <?php
            // connect to database
            $dbc = @mysqli_connect("localhost", "root", "MyCSC211!", "myblog");

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

                    // print delete form
                    print   "<form action='delete_entry.php' method='post'>
                                <p>Are you sure you want to delete this entry?</p>
                                <p><h3>" . $row["title"] . "</h3>" . $row["entry"] . "<br>
                                <input type='hidden' name='id' value='" . $_GET["id"] . "'>
                                <input type='submit' name='submit' value='Delete this Entry!'></p>
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
                // define & initialize query
                $query = "DELETE FROM entries WHERE id={$_POST['id']} LIMIT 1";

                // execute query
                $r = mysqli_query($dbc, $query);

                // determine if successful delete
                if (mysqli_affected_rows($dbc) == 1)
                {
                    // print deleted message
                    print "<p>The blog entry has been deleted.</p>";
                }
                else
                {
                    // print error message
                    print   "<p style='color: red;'>Could not delete the blog entry because:<br>" . 
                            mysqli_error($dbc) . ".</p><p>The query being run was: " . $query . "</p>";
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