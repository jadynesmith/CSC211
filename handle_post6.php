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
            $first_name = trim($_POST['first_name']);
            $last_name = trim($_POST['last_name']);
            $posting = trim(nl2br($_POST['posting'], false));

            // concatenate full name variable
            $full_name = $first_name . ' ' . $last_name;

            // get posting word count & snippet
            $word_count = str_word_count($posting);

            // take out all bad words
            $posting = str_ireplace('badword1', '*****', $posting);
            $posting = str_ireplace('badword2', '*****', $posting);
            $posting = str_ireplace('badword3', '*****', $posting);

            // print post verification message
            print " <div>Thank you, $full_name, for your posting:
                    <p>$posting</p></div>
                    <p>($word_count words)</p>";
        ?>
    </body>
</html>