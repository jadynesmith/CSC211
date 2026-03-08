<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            View My Blog
        </title>
    </head>
    <body>
        <h1>
            My Blog
        </h1>

        <?php
            // connect to database
            $dbc = @mysqli_connect("localhost", "root", "MyCSC211!", "myblog");

            // define & initialize query
            $query = "SELECT * FROM entries ORDER BY date_entered DESC";

            // attempt query execution
            if ($r = mysqli_query($dbc, $query))
            {
                // while there are blog posts
                while ($row = mysqli_fetch_array($r))
                {
                    // print blog post
                    print   "<p><h3>{$row['title']}</h3>{$row['entry']}<br>
                            <a href=\"edit_entry.php?id={$row['id']}\">Edit</a>
                            <a href=\"delete_entry.php?id={$row['id']}\">Delete</a>
                            </p><hr>\n";
                }
            }
            else
            {
                // print error message
                print   "<p style='color: red;'>Could not retrieve the data because:<br>" . 
                        mysqli_error($dbc) . ".</p><p>The query being run was: " . "</p>";
            }

            // disconnect from database
            mysqli_close($dbc);
        ?>
    </body>
</html>