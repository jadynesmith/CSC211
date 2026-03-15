<?php
    // start session
    session_start();

    // enable display errors
    ini_set("display_errors", 1);

    // set error reporting to highest level
    error_reporting(E_ALL);

    // define & initialize title constant
    define("TITLE", "Login");

    // include header file
    include("templates/header.html");

    // define & initialize sticky input function
    function sticky($name)
    {
        // determine if form item has been set
        if (isset($_POST["$name"]))
        {
            // print sticky form item
            print " value='" .  htmlspecialchars($_POST[$name]) . "'";
        }
        else
        {
            // print empty form item
            print "";
        }
    }
?>
<!-- NAVIGATION START -->
<nav>
    <div class="half-box short">
        <div class="left-nav">
            <img class="logo" src="images/logo.png" alt="cooking pot logo">
        </div>
        <div class="right-nav">
            <a class="nav" href="references.php">References</a>
        </div>
    </div>
</nav>
<!-- NAVIGATION END -->
<!-- CONTENT START -->
<main>
    <div class="container">
        <div class="content">
            <h3>ENTER YOUR CREDENTIALS TO LOGIN</h3>
            <?php
                // 1ST STEP: DETERMINE IF FORM HAS BEEN SUBMITTED

                // determine if form has already been submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    // 2ND STEP: DETERMINE IF FORM ITEMS ARE VALID

                    // define & initialize flag
                    $isValid = TRUE;

                    // determine if form items are incomplete
                    if (empty($_POST["email_address"]) ||
                        empty($_POST["password"]))
                    {
                        // update flag
                        $isValid = FALSE;

                        // print error message
                        print "<p class='error'>Please enter all form data.</p>";
                    }

                    // determine if multiple email addresses are present
                    if (substr_count($_POST["email_address"], "@") != 1)
                    {
                        // update flag
                        $isValid = FALSE;

                        // print error message
                        print "<p class='error'>Please enter only a singular email address that includes a singular @ symbol.</p>";
                    }

                    // determine if input is completely valid
                    if ($isValid)
                    {
                        // 3RD STEP: ATTEMPT DATABASE LOGIN

                        // attempt database connection
                        if ($dbc = @mysqli_connect("localhost", "root", "MyCSC211!", "final_project"))
                        {
                            // call method to set character set
                            mysqli_set_charset($dbc, "utf8");

                            // 4TH STEP: TRIM, STRIP, SECURE, & LOWERCASE FORM ITEMS

                            // trim, strip tags, secure & lowercase form items
                            $email_address = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["email_address"]))));
                            $password = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["password"])));

                            // 5TH STEP: CHECK IF USER EXISTS

                            // define & initialize email duplicate query
                            $email_dup_query = "SELECT email_address FROM users WHERE email_address = '$email_address'";

                            // attempt email duplication query
                            $email_dup_result = mysqli_query($dbc, $email_dup_query);

                            // determine if email duplication result is valid
                            if ($email_dup_result != FALSE)
                            {
                                // determine if email is not registered
                                if (mysqli_num_rows($email_dup_result) == 0)
                                {
                                    // print error message
                                    print "<p class='error'>That email address has not been registered.</p>";
                                }
                                else
                                {
                                    // 6TH STEP: CAPTURE PASSWORD & USER ID FROM DATABASE

                                    // define & initialize verify query
                                    $verify_query = "SELECT hashed_password, user_id FROM users WHERE email_address = '$email_address'";

                                    // attempt verify query execution
                                    $verify_result = mysqli_query($dbc, $verify_query);

                                    // determine if verify query result is valid
                                    if ($verify_result != FALSE)
                                    {
                                        // determine if row has been captured
                                        if (mysqli_num_rows($verify_result) > 0)
                                        {
                                            // define & initialize row
                                            $row = mysqli_fetch_assoc($verify_result);

                                            // 7TH STEP: CHECK IF PASSWORD IS CORRECT

                                            // collect hashed password from row
                                            $hashed_password = $row["hashed_password"];

                                            // verify entered password against hashed password
                                            $verify = password_verify($password, $hashed_password);

                                            // determine if password is correct
                                            if ($verify)
                                            {
                                                // 8TH STEP: STORE USER ID IN SESSION

                                                // close database connection
                                                mysqli_close($dbc);

                                                // collect user id in session
                                                $_SESSION["user_id"] = $row["user_id"];

                                                // 9TH STEP: REDIRECT TO RECIPE BLOG

                                                // redirect to recipe blog
                                                ob_end_clean();
                                                header ("Location: recipe_blog.php");

                                                // exit script
                                                exit();
                                            }
                                            else
                                            {
                                                // print error message
                                                print "<p class='error'>The given password is incorrect.</p>";
                                            }
                                        }
                                        else
                                        {
                                            // print error message
                                            print "<p class='error'>Could not verify password because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $verify_query . "</p>";
                                        }
                                    }
                                    else
                                    {
                                        // print error message
                                        print "<p class='error'>Could not verify password because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $verify_query . "</p>";
                                    }
                                }
                            }
                        }
                    }
                }
            ?>
            <form action="login.php" method="post">
                <!-- capture form data from user -->
                <div class="box">
                    <label>Email Address</label>
                    <input type="email" name="email_address" <?php sticky("email_address");?>>
                </div>
                <div class="box">
                    <label>Password</label>
                    <input type="password" name="password">
                </div>
                
                <!-- submit form data -->
                <input type="submit" name="submit" value="LOGIN" class="button"><br><br>

                <a class="ref" href="index.php">Don't Have An Account? Register Instead.</a>
            </form>
        </div>
        <div class="content">
            <div class="box">
                <img src="images/cooking.jpg" alt="A stovetop with a woman stirring a red pot of milky content in front of an orange dutch oven">
                <aside>
                    Photo By: <a class="ref" href="https://www.pexels.com/photo/a-woman-cooking-milk-10821210/">furkanfdemir</a>
                </aside>
            </div>
        </div>
    </div>
</main>
<!-- CONTENT END -->
<?php
    // include footer file
    include("templates/footer.html");
?>