<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Sticky Text Inputs
        </title>
    </head>
    <body>
        <?php
            // sticky text input function with 2 args
            function make_text_input($name, $label)
            {
                // print label
                print "<p><label>" . $label . ": ";

                // print input
                print "<input type='text' name='" . $name . "' size='20' ";

                // determine if name is set
                if (isset($_POST[$name]))
                {
                    // print value
                    print " value='" . htmlspecialchars($_POST[$name]) . "' size='20' ";
                }

                // print end of label
                print "></label></p>";
            }

            // print start of form
            print "<form action='' method='post'>";

            // call make_text_input function to create text inputs
            make_text_input("first_name", "First Name");
            make_text_input("last_name", "Last Name");
            make_text_input("email", "Email Address");

            // print submit button & end of form
            print "<input type='submit' name='submit' value='Register!'></form>"
        ?>
    </body>
</html>