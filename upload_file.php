<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Upload a File
        </title>
    </head>
    <body>
        <?php
            // determine if form has been uploaded
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // determine if file upload is possible
                if (move_uploaded_file($_FILES["the_file"]["tmp_name"], "../../uploads/{$_FILES['the_file']['name']}"))
                {
                    // print file uploaded message
                    print "<p>Your file has been uploaded.</p>";
                }
                else
                {
                    // print start of error message
                    print "<p style='color: red;'>Your file could not be uploaded because: ";

                    // print error reason
                    switch ($_FILES["the_file"]["error"])
                    {
                        case 1:
                            print "The file exceeds the upload_max_filesize setting in php.ini";
                            break;
                        case 2:
                            print "The file exceed the MAX_FILE_SIZE setting in the HTML form";
                            break;
                        case 3:
                            print "The file was only partially uploaded";
                            break;
                        case 4:
                            print "No file was uploaded";
                            break;
                        case 5:
                            print "The temporary folder does not exist";
                            break;
                        default:
                            print "Something  unforeseen happened";
                            break;
                    }

                    // print end of error message
                    print ".</p>";
                }
            }
        ?>

        <!-- display the form -->
        <form action="upload_file.php" enctype="multipart/form-data" method="post">
            <p>
                Upload a file using this form:
            </p>
            <input type="hidden" name="MAX_FILE_SIZE" value="300000">
            <p>
                <input type="file" name="the_file">
            </p>
            <p>
                <input type="submit" name="submit" value="Upload This File">
            </p>
        </form>
    </body>
</html>