<?php
    // enable display errors
    ini_set("display_errors", 1);

    // set error reporting to highest level
    error_reporting(E_ALL);

    // define & initialize title constant
    define("TITLE", "Register");

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
            <h3>REGISTER USING THE FORM BELOW</h3>
            <?php
                // 1ST STEP: DETERMINE IF FORM HAS BEEN SUBMITTED

                // determine if form has already been submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    // 2ND STEP: DETERMINE IF FORM ITEMS ARE VALID

                    // define & initialize flag
                    $isValid = TRUE;

                    // determine if form items are incomplete
                    if (empty($_POST["first_name"]) ||
                        empty($_POST["last_name"]) || 
                        empty($_POST["phone_number"]) ||
                        empty($_POST["email_address"]) ||
                        empty($_POST["password"]) ||
                        empty($_POST["confirm_password"]) ||
                        empty($_POST["street_address"]) ||
                        empty($_POST["city"]) ||
                        empty($_POST["state"]) ||
                        empty($_POST["zip_code"]))
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

                    // determine if password confirmation does not match password
                    if ($_POST["password"] != $_POST["confirm_password"])
                    {
                        // update flag
                        $isValid = FALSE;

                        // print error message
                        print "<p class='error'>Your original password does not match your confirmation password.</p>";
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
                            $first_name         = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["first_name"]))));
                            $last_name          = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["last_name"]))));
                            $phone_number       = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["phone_number"]))));
                            $email_address      = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["email_address"]))));
                            $password           = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["password"])));
                            $confirm_password   = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["confirm_password"])));
                            $street_address     = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["street_address"]))));
                            $city               = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["city"]))));
                            $state              = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["state"]))));
                            $zip_code           = strtolower(mysqli_real_escape_string($dbc, trim(strip_tags($_POST["zip_code"]))));

                            // 5TH STEP: CHECK IF USER ALREADY EXISTS

                            // define & initialize email duplicate query
                            $email_dup_query = "SELECT email_address FROM users WHERE email_address = '$email_address'";

                            // attempt email duplication query
                            $email_dup_result = mysqli_query($dbc, $email_dup_query);

                            // determine if email duplication result is valid
                            if ($email_dup_result != FALSE)
                            {
                                // determine if email is already registered
                                if (mysqli_num_rows($email_dup_result) > 0)
                                {
                                    // print error message
                                    print "<p class='error'>That email address has already been registered.</p>";
                                }
                                else
                                {
                                    // 6TH STEP: PREPARE DATA FOR DATABASE

                                    // combine first & last name
                                    $full_name = $first_name . " " . $last_name;

                                    // hash the password
                                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                                    // define & initialize insert query
                                    $insert_query =    "INSERT INTO
                                                        users (full_name, street_address, city, state, zip_code, phone_number, email_address, hashed_password, joined)
                                                        VALUES ('$full_name', '$street_address', '$city', '$state', '$zip_code', '$phone_number', '$email_address', '$hashed_password', NOW())";

                                    // attempt insert query execution
                                    $insert_result = mysqli_query($dbc, $insert_query);

                                    // determine if insert query result is valid
                                    if ($insert_result != FALSE)
                                    {
                                        // 7TH STEP: CAPTURE USER ID FROM DATABASE, START SESSION, & STORE USER ID IN SESSION

                                        // define & initialize capture query
                                        $capture_query =    "SELECT user_id FROM users WHERE email_address = '$email_address'";

                                        // attempt capture query execution
                                        $capture_result = mysqli_query($dbc, $capture_query);

                                        // determine if capture query result is valid
                                        if ($capture_result != FALSE)
                                        {
                                            // determine if row has been captured
                                            if (mysqli_num_rows($capture_result) > 0)
                                            {
                                                // define & initialize row
                                                $row = mysqli_fetch_assoc($capture_result);

                                                // close database connection
                                                mysqli_close($dbc);

                                                // start session
                                                session_start();

                                                // collect user id in session
                                                $_SESSION["user_id"] = $row["user_id"];

                                                // 8TH STEP: REDIRECT TO RECIPE BLOG

                                                // redirect to recipe blog
                                                ob_end_clean();
                                                header ("Location: recipe_blog.php");

                                                // exit script
                                                exit();
                                            }
                                            else
                                            {
                                                // print error message
                                                print "<p class='error'>Could not capture user id because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $capture_query . "</p>";
                                            }
                                        }
                                        else
                                        {
                                            // print error message
                                            print "<p class='error'>Could not capture user id because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $capture_query . "</p>";
                                        }
                                    }
                                    else
                                    {
                                        // print error message
                                        print "<p class='error'>Could not add user because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $insert_query . "</p>";
                                    }
                                }
                            }
                            else
                            {
                                // print error message
                                print "<p class='error'>Could not check for duplicate account because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $email_dup_query . "</p>";
                            }
                        }
                        else
                        {
                            // print error message
                            print "<p class='error'>Could not connect to the database:<br>" . mysqli_connect_error() . "</p>";
                        }
                    }
                }
            ?>
            <form action="index.php" method="post">
                <!-- capture personal details from user -->
                <div class="half-box">
                    <label>First Name</label>
                    <label>Last Name</label>
                    <input type="text" name="first_name"<?php sticky("first_name");?>>
                    <input type="text" name="last_name"<?php sticky("last_name");?>>
                </div>
                <div class="box">
                    <label>Phone Number</label>
                    <input type="tel" name="phone_number"<?php sticky("phone_number");?>>
                </div>
                <div class="box">
                    <label>Email Address</label>
                    <input type="email" name="email_address"<?php sticky("email_address");?>>
                </div>
                <div class="half-box">
                    <label>Password</label>
                    <label>Confirm Password</label>
                    <input type="password" name="password">
                    <input type="password" name="confirm_password">
                </div>
                <div class="box">
                    <label>Street Address</label>
                    <input type="text" name="street_address"<?php sticky("street_address");?>>
                </div>
                <div class="third-box">
                    <label>City</label>
                    <label>State</label>
                    <label>Zip Code</label>
                    <input type="text" name="city"<?php sticky("city");?>>
                    <input type="text" name="state"<?php sticky("state");?>>
                    <input type="text" name="zip_code"<?php sticky("zip_code");?>>
                </div>

                <!-- submit form data -->
                <input type="submit" name="submit" value="REGISTER" class="button"><br><br>

                <a class="ref" href="login.php">Already Have An Account? Login Instead.</a>
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