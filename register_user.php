<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Register User
        </title>
    </head>
    <body>
        <h1>
            Register User
        </h1>

        <?php
            // define & initialize directory & file
            $dir = "../../users/";
            $file = $dir . "users.txt";

            // determine if form has been submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // define & initialize problem as false
                $problem = FALSE;

                // determine if values are completed
                if (empty($_POST["username"]))
                {
                    // change problem to true
                    $problem = TRUE;

                    // print error message
                    print "<p class='error'>Please enter a username!'</p>";
                }

                if (empty($_POST["password1"]))
                {
                    // change problem to true
                    $problem = TRUE;

                    // print error message
                    print "<p class='error'>Please enter a password!'</p>";
                }

                if ($_POST["password1"] != $_POST["password2"])
                {
                    // change problem to true
                    $problem = TRUE;

                    // print error message
                    print "<p class='error'>Your password did not match your confirmed password!'</p>";
                }

                // determine if there were no problems
                if (!$problem)
                {
                    // determine if file is writable
                    if (is_writable($file))
                    {
                        $subdir = time() . rand(0, 4596);
                        $data = $_POST["username"] . "\t" . sha1(trim($_POST["password1"])) . "\t" . $subdir . PHP_EOL;

                        // write data to file
                        file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

                        // create directory
                        mkdir ($dir . $subdir);

                        // print registered message
                        print "<p>You are now registered!</p>";
                    }
                    else
                    {
                        // print error message
                        print "<p class='error'>You could not be registered due to a system error.</p>";
                    }
                }
                else
                {
                    // print error message
                    print "<p class='error'>Please go back & try again!</p>";
                }
            }
            else
            {
                // display the form
        ?>

        <!-- create form -->
        <form action="register_user.php" method="post">
            <p>
                Username: <input type="text" name="username" size="20">
            </p>
            <p>
                Password: <input type="password" name="password1" size="20">
            </p>
            <p>
                Confirm Password: <input type="password" name="password2" size="20">
            </p>
            <input type="submit" name="submit" value="Register User">
        </form>

        <?php
            // complete if statement
            }
        ?>
    </body>
</html>