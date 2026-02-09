<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Forum Posting
        </title>
    </head>
    <body>
        <?php
            // define & initialize variables via $_POST array
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $posting = nl2br($_POST['posting'], false);

            // concatenate full name variable
            $full_name = $first_name . ' ' . $last_name;

            // get posting word count & snippet
            $word_count = str_word_count($posting);
            $posting_snippet = substr($posting, 0, 50);

            // print post verification message
            print " <div>Thank you, $full_name, for your posting:
                    <p>$posting_snippet...</p></div>
                    <p>($word_count words)</p>";
        ?>
    </body>
</html>