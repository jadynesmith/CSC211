<?php
    // define & initialize title constant
    define("TITLE", "Login");

    // include header file
    include("templates/header.html");

    // print introductory text
    print " <h2>Login Form</h2>
            <p>Users who are logged in can take 
            advantage of certain features like 
            this, that, & the other thing.</p>";

    // check if form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check if email & password fields are not empty
        if ((!empty($_POST["email"])) && (!empty($_POST["password"])))
        {
            // check if email & password are correct
            if ((strtolower($_POST["email"]) == "me@example.com") && ($_POST["password"] == "testpass"))
            {
                // start session
                session_start();

                // collect session details
                $_SESSION["email"] = $_POST["email"];
                $_SESSION["loggedin"] = time();

                // redirect user to welcome page
                ob_end_clean();
                header ("Location: welcome.php");
                exit();
            }
            else
            {
                // print error message
                print "<p class='text--error'>The submitted email address 
                        & password do not match those on file!<br>
                        Go back & try again.</p>";
            }
        }
        else
        {
            // print error message
            print " <p class='text--error'>Please make sure you enter both
                    an email & password!<br>Go back & try again.</p>";
        }
    }
    else
    {
        // display the form
        print " <form action='login.php' method='post' class='form--inline'>
                <p><label for='email'>Email Address:</label>
                <input type='email' name='email' size='20'></p>
                <p><label for='password'>Password:</label>
                <input type='password' name='password' size='20'></p>
                <p><input type='submit' name='submit' value='Log In!'
                class='button--pill'></p></form>";
    }

    // include footer file
    include("templates/footer.html");
?>