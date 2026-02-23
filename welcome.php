<?php
    // start the session
    session_start();

    // define title constant
    define("TITLE", "Welcome to the 3.0 Salinger Fan Club!");

    // include the header
    include("templates/header.html");

    // print greeting
    print "<h2>Welcome to the J.D. Salinger Fan Club!</h2>";
    print "<p>Hello, " . $_SESSION["email"] . "!</p>";

    // set timezone
    date_default_timezone_set("America/Phoenix");

    // print session length
    print " <p>You have been logged in since: " .
            date("g:i a", $_SESSION["loggedin"]) .
            ".</p>";
    
    // logout link
    print "<p><a href='logout.php'>Logout</a></p>";

    // include the footer
    include("templates/footer.html");
?>