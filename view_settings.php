<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>View Your Settings</title>
        <style type="text/css">
            body
            {
                <?php
                    // check if font_size value is set
                    if (isset($_COOKIE["font_size"]))
                    {
                        // print chosen font size
                        print "\t\tfont-size: " . htmlentities($_COOKIE["font_size"]) . ";\n";
                    }
                    else
                    {
                        // print default font size
                        print "\t\tfont-size: medium;";
                    }

                    // check if font_color value is set
                    if (isset($_COOKIE["font_color"]))
                    {
                        // print chosen font color
                        print "\t\tcolor: #" . htmlentities($_COOKIE["font_color"]) . ";\n";
                    }
                    else
                    {
                        // print default font color
                        print "\t\tcolor: #000;";
                    }
                ?>
            }
        </style>
    </head>
    <body>
        <p>
            <a href="customize.php">Customize Your Settings</a>
        </p>

        <p>
            yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda yadda 
        </p>
    </body>
</html>