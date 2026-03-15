<?php
    // enable display errors
    ini_set("display_errors", 1);

    // set error reporting to highest level
    error_reporting(E_ALL);

    // define & initialize title constant
    define("TITLE", "References");

    // include header file
    include("templates/header.html");
?>
<!-- NAVIGATION START -->
<nav>
    <div class="half-box short">
        <div class="left-nav">
            <img class="logo" src="images/logo.png" alt="cooking pot logo">
        </div>
        <div class="right-nav">
            <a class="nav" href="index.php">Register</a>
            |
            <a class="nav" href="login.php">Log In</a>
        </div>
    </div>
</nav>
<!-- NAVIGATION END -->
<!-- CONTENT START -->
<main>
    <div class="container">
        <div class="content">
            <p>
                "Cazuela the Allotment Cooks: A-Z Recipe Book Cookware Pots, Cooking Pot Transparent Background PNG Clipart | HiClipart." Hiclipart.com, 2026, www.hiclipart.com/free-transparent-background-png-clipart-moeua. Accessed 14 Mar. 2026.
            </p>
            <p>
                "CSS Transform Property." Www.w3schools.com, www.w3schools.com/cssref/css3_pr_transform.php.
            </p>
            <p>
                GeeksforGeeks. "How to Make a Redirect in PHP?" GeeksforGeeks, 17 Oct. 2018, www.geeksforgeeks.org/php/how-to-make-a-redirect-in-php/.
            </p>
            <p>
                GeeksforGeeks. "Password Hashing and Verification in PHP." GeeksforGeeks, 18 Aug. 2020, www.geeksforgeeks.org/php/how-to-encrypt-and-decrypt-passwords-using-php/.
            </p>
            <p>
                Manual. "PHP: Ucwords - Manual." Php.net, 2025, www.php.net/manual/en/function.ucwords.php.
            </p>
            <p>
                "PHP Mysqli Fetch_assoc() Function." Www.w3schools.com, www.w3schools.com/PHP/func_mysqli_fetch_assoc.asp.
            </p>
            <p>
                W3Schools. "HTML Input Types." W3schools.com, 2019, www.w3schools.com/html/html_form_input_types.asp.
            </p>
        </div>
    </div>
</main>
<!-- CONTENT END -->
<?php
    // include footer file
    include("templates/footer.html");
?>