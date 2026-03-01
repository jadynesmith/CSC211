<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Date Menus
        </title>
    </head>
    <body>
        <?php
            // make 3 pull-down menus - one for months, one for days, & one for years
            function make_date_menus()
            {
                // define & initialize months array
                $months = 
                [
                    1 =>    'January',
                            'February',
                            'March',
                            'April',
                            'May',
                            'June',
                            'July',
                            'August',
                            'September',
                            'October',
                            'November',
                            'December'
                ];

                // print start of month menu
                print '<select name="month">';

                // iterate through months array for menu options
                foreach ($months as $key => $value)
                {
                    // print current month
                    print "\n<option value=\"$key\">$value</option>";
                }

                // print end of month menu code
                print '</select>';

                // print start of day menu
                print '<select name="day">';

                // iterate through 31 days for menu options
                for ($day = 1; $day <= 31; $day++)
                {
                    // print current day
                    print "\n<option value=\"$day\">$day</option>";
                }

                // print end of day menu code
                print '</select>';

                // print start of year menu
                print '<select name="year">';

                // define & initialize start_year variable
                $start_year = date('Y');

                // iterate through 10 years for menu options
                for ($year = $start_year; $year <= ($start_year + 10); $year++)
                {
                    // print current year
                    print "\n<option value=\"$year\">$year</option>";
                }

                // print end of year menu code
                print '</select>';
            }

            // print the start of the form
            print '<form action="" method="post">';

            // call make_date_menus() function
            make_date_menus();

            // print the end of the form
            print '</form>';
        ?>
    </body>
</html>