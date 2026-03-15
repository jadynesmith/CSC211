<?php
    // start session
    session_start();

    // determine if user is not logged in
    if (!isset($_SESSION["user_id"]))
    {
        // return to login page
        ob_end_clean();
        header("Location: login.php");

        // exit script
        exit();
    }

    // enable display errors
    ini_set("display_errors", 1);

    // set error reporting to highest level
    error_reporting(E_ALL);

    // attempt database connection
    if ($dbc = mysqli_connect("localhost", "root", "MyCSC211!", "final_project"))
    {
        // call method to set character set
        mysqli_set_charset($dbc, "utf8");

        // capture user id from session
        $user_id = mysqli_real_escape_string($dbc, $_SESSION["user_id"]);

        // define & initialize select info query
        $select_info_query = "SELECT full_name, joined FROM users WHERE user_id = '$user_id'";

        // run select info query
        $select_info_result = mysqli_query($dbc, $select_info_query);

        // determine if user data can be found
        if ($select_info_result != FALSE && mysqli_num_rows($select_info_result) > 0)
        {
            // capture user information from database
            $user = mysqli_fetch_assoc($select_info_result);

            // define & initialize full name
            $full_name = ucwords($user["full_name"]);

            // define & initialize joined
            $joined = $user["joined"];
        }
        else
        {
            // define & initialize default variables
            $full_name = "Guest";
            $joined = "Unknown";
        }
    }
    else
    {
        // print error message
        print "<p class='error'>Could not connect to the database:<br>" . mysqli_connect_error() . "</p>";
    }

    // define & initialize title constant
    define("TITLE", "Recipe Blog");

    // include header file
    include("templates/header.html");

    // define & initialize categories array
    $categories = array(
        "Breakfast",
        "Lunch",
        "Dinner",
        "Appetizer",
        "Dessert",
        "Beverage"
    );

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
            <span>
                <?php
                    print htmlspecialchars($full_name);
                ?>
            </span>
        </div>
        <div class="right-nav">
            <a class="nav" href="logout.php">Log Out</a>
        </div>
    </div>
</nav>
<!-- NAVIGATION END -->
<!-- CONTENT START -->
<main>
    <div class="container">
        <div class="content">
            <h3>POST A RECIPE USING THE FORM BELOW</h3>
            <?php
                // 1ST STEP: CHECK IF FORM HAS BEEN SUBMITTED OR DELETED

                // determine if form has been deleted
                if (isset($_POST["delete"]))
                {
                    // define & initialize delete id
                    $delete_id = intval($_POST["delete_id"]);

                    // define & initialize delete query
                    $delete_query = "DELETE FROM recipes
                                    WHERE recipe_id = $delete_id
                                    AND creator = '$full_name'";
                    
                    // attempt delete query
                    if (mysqli_query($dbc, $delete_query))
                    {
                        // print success message
                        print "<p>Recipe successfully deleted.</p>";
                    }
                    else
                    {
                        // print error message
                        print "<p class='error'>Could not delete recipe:<br>" . mysqli_error($dbc) . "</p>";
                    }
                }

                // determine if form has been submitted
                if (isset($_POST["submit"]))
                {
                    // 2ND STEP: DETERMINE IF FORM ITEMS ARE VALID

                    // define & initialize flag
                    $isValid = TRUE;

                    // determine if form items are incomplete
                    if (empty($_POST["title"]) ||
                        empty($_POST["category"]) ||
                        empty($_POST["serving_size"]) ||
                        empty($_POST["prep_time"]) ||
                        empty($_POST["cook_time"]) ||
                        empty($_POST["ingredients"]) ||
                        empty($_POST["directions"]))
                    {
                        // update flag
                        $isValid = FALSE;

                        // print error message
                        print "<p class='error'>All fields but Tags are required.</p>";
                    }

                    // determine if input is completely valid
                    if ($isValid)
                    {
                        // 3RD STEP: TRIM, STRIP, SECURE, & CALCULATE FORM ITEMS

                        // trim, strip, secure, & calculate form items
                        $title = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["title"])));
                        $category = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["category"])));
                        $serving_size = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["serving_size"])));
                        $prep_time = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["prep_time"])));
                        $cook_time = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["cook_time"])));
                        $total_time = $prep_time + $cook_time;
                        $ingredients = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["ingredients"])));
                        $directions = mysqli_real_escape_string($dbc, trim(strip_tags($_POST["directions"])));

                        // define & initialize tags array
                        $tags = array();

                        // capture tags
                        if (isset($_POST["gluten_free"]))
                        {
                            $tags[] = "Gluten Free";
                        }
                        if (isset($_POST["dairy_free"]))
                        {
                            $tags[] = "Dairy Free";
                        }
                        if (isset($_POST["vegetarian"]))
                        {
                            $tags[] = "Vegetarian";
                        }
                        if (isset($_POST["vegan"]))
                        {
                            $tags[] = "Vegan";
                        }
                        if (isset($_POST["paleo"]))
                        {
                            $tags[] = "Paleo";
                        }
                        if (isset($_POST["keto"]))
                        {
                            $tags[] = "Keto";
                        }

                        // implode tags to add commas
                        $imploded_tags = implode(", ", $tags);

                        // 4TH STEP: CHECK IF USER ALREADY EXISTS

                        // define & initialize title duplicate query
                        $title_dup_query = "SELECT title
                                            FROM recipes 
                                            WHERE creator = '$full_name' 
                                            AND title = '$title'";

                        // attempt title duplication query
                        $title_dup_result = mysqli_query($dbc, $title_dup_query);

                        // determine if title duplication result is valid
                        if ($title_dup_result != FALSE)
                        {
                            // determine if title is already posted
                            if (mysqli_num_rows($title_dup_result) > 0)
                            {
                                // print error message
                                print "<p class='error'>That title has already been posted by you.</p>";
                            }
                            else
                            {
                                // 5TH STEP: ADD RECIPE TO DATABASE

                                // define & initialize insert recipe query
                                $insert_recipe_query = "INSERT INTO recipes
                                                (creator, title, tags, category, serving_size, prep_time, cook_time, total_time, ingredients, directions, posted)
                                                VALUES
                                                ('$full_name', '$title', '$imploded_tags', '$category', '$serving_size', '$prep_time', '$cook_time', '$total_time', '$ingredients', '$directions', NOW())";

                                // attempt to run insert recipe query
                                if (@mysqli_query($dbc, $insert_recipe_query))
                                {
                                    // print success message
                                    print "<p>The recipe entry has been added!</p>";
                                }
                                else
                                {
                                    // print error message
                                    print "<p class='error'>Could not add the recipe entry because:<br>" . mysqli_error($dbc) . ".</p><p>The query being run was: " . $insert_recipe_query . "</p>";
                                }
                            }
                        }
                        else
                        {
                            // print error message
                            print "<p class='error'>Could not check for duplicate recipe because:<br>" . mysqli_error($dbc) . "</p><p>The query being run was: " . $title_dup_query . "</p>";
                        }
                    }
                }

                // 6TH STEP: CAPTURE RECIPES

                // define & initialize select recipe query
                $select_recipe_query = "SELECT recipe_id, creator, title, tags, category, serving_size, prep_time, cook_time, total_time, ingredients, directions, posted
                                        FROM recipes
                                        ORDER BY posted DESC";

                $select_recipe_result = @mysqli_query($dbc, $select_recipe_query);
            ?>
            <form action="recipe_blog.php" method="post">
                <!-- capture recipe details from user -->
                <div class="box">
                    <label>Recipe Title</label>
                    <input type="text" name="title"<?php sticky("title");?>>
                </div>
                <label>Tags</label>
                <div class="sixth-box">
                    <label>Gluten-Free</label>
                    <label>Dairy-Free</label>
                    <label>Vegetarian</label>
                    <label>Vegan</label>
                    <label>Paleo</label>
                    <label>Keto</label>
                    <input type="checkbox" name="gluten_free" value="Gluten-Free"<?php if(isset($_POST["gluten_free"])) print "checked";?>>
                    <input type="checkbox" name="dairy_free" value="Dairy-Free"<?php if(isset($_POST["dairy_free"])) print "checked";?>>
                    <input type="checkbox" name="vegetarian" value="Vegetarian"<?php if(isset($_POST["vegetarian"])) print "checked";?>>
                    <input type="checkbox" name="vegan" value="Vegan"<?php if(isset($_POST["vegan"])) print "checked";?>>
                    <input type="checkbox" name="paleo" value="Paleo"<?php if(isset($_POST["paleo"])) print "checked";?>>
                    <input type="checkbox" name="keto" value="Keto"<?php if(isset($_POST["keto"])) print "checked";?>>
                </div>
                <div class="half-box">
                    <label>Category</label>
                    <label>Serving Size</label>
                    <select name="category">
                        <option value="">Select a Category</option>
                        <?php
                            // iterate through categories array
                            foreach ($categories as $category)
                            {
                                // print start of category option
                                print "<option value='$category'";

                                // determine if category has been selected
                                if (isset($_POST["category"]) && $_POST["category"] == $category)
                                {
                                    // print selected
                                    print " selected";
                                }

                                // print end of category option
                                print ">$category</option>";
                            }
                        ?>
                    </select>
                    <input type="number" name="serving_size"<?php sticky("serving_size");?>>
                </div>
                <div class="half-box">
                    <label>Prep Time (Mins)</label>
                    <label>Cook Time (Mins)</label>
                    <input type="number" name="prep_time"<?php sticky("prep_time");?>>
                    <input type="number" name="cook_time"<?php sticky("cook_time");?>>
                </div>
                <div class="box">
                    <label>Ingredients</label>
                    <textarea name="ingredients" cols="40" rows="5"><?php if(isset($_POST["ingredients"])) print htmlspecialchars($_POST["ingredients"]);?></textarea>
                </div>
                <div class="box">
                    <label>Directions</label>
                    <textarea name="directions" cols="40" rows="10"><?php if(isset($_POST["directions"])) print htmlspecialchars($_POST["directions"]);?></textarea>
                </div>

                <!-- submit form data -->
                <input type="submit" name="submit" value="POST RECIPE!" class="button"><br><br>
            </form>
        </div>
        <div class="content">
            <h3>SEE MOST RECENT POSTED RECIPES BELOW</h3>
            <?php
                // attempt to execute select recipe query
                if ($select_recipe_result)
                {
                    // determine if there are posted recipes
                    if(mysqli_num_rows($select_recipe_result) > 0)
                    {
                        // fetch all recipes available
                        while ($row = mysqli_fetch_assoc($select_recipe_result))
                        {
                            // display recipe
                            print "<hr class='post-divider'>";
                            print "<h4>" . htmlspecialchars($row["title"]) . " - " . htmlspecialchars($row["creator"]) . "</h4>";
                            print "<div class='box'>" . htmlspecialchars($row["category"]) . " (" . htmlspecialchars($row["tags"]) . ")</div>";
                            print "<div class='box'>Ingredients: " . htmlspecialchars($row["ingredients"]) . "</div>";
                            print "<div class='box'>Directions: " . htmlspecialchars($row["directions"]) . "</div>";
                            print "<div class='third-box'><p>Prep Time:</p><p>Cook Time:</p><p>Total Time:</p><p>" . htmlspecialchars($row["prep_time"]) . " minutes</p><p>" . htmlspecialchars($row["cook_time"]) . " minutes</p><p>" . htmlspecialchars($row["total_time"]) . " minutes</p></div>";
                            print "<div class='box'>" . htmlspecialchars($row["posted"]) . "</div>";

                            // determine if user is creator
                            if ($row["creator"] == $full_name)
                            {
                                // display delete button
                                print "<form method='post' action='recipe_blog.php'>";
                                print "<input type='hidden' name='delete_id' value='" . $row["recipe_id"] . "'>";
                                print "<input type='submit' name='delete' value='Delete' class='button'>";
                                print "</form>";
                            }
                        }
                    }
                    else
                    {
                        // print no posted recipes message
                        print "<p>No recipes posted yet...</p>";
                    }
                }
                else
                {
                    // print error message
                    print "<p class='error'>Could not show recipe entries because:<br>" . mysqli_error($dbc) . ".</p><p>The query being run was: " . $select_recipe_query . "</p>";
                }
            ?>
        </div>
    </div>
</main>
<!-- CONTENT END -->
<?php
    // close database connection
    mysqli_close($dbc);

    // include footer file
    include("templates/footer.html");
?>