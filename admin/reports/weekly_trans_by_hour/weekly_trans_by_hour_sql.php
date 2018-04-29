<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/functions.php');

// This file contains all SQL statements and how they're handled

// variables
$todays_date = new DateTime('2018-01-18'); // test date value (delete this in prod)
//$todays_date = new DateTime(date("Y-m-d")); //uncomment to get today's date
$current_date_details = get_year_month_week($todays_date->format('Y-m-d'));
$week_array = get_week_start_end($current_date_details['week'], $current_date_details['year']);
$quarter = get_quarter($todays_date);
$dates_as_strings['today'] = date_to_sqldate($todays_date);

// queries

$test = '
SELECT
DAYOFWEEK(t_start) AS Day,
HOUR( t_start ) AS HOUR,
COUNT( HOUR( t_start ) ) AS  "# Tickets"
FROM transactions
WHERE  t_start BETWEEN  "2017-12-01 00:00:00" AND "2018-12-08 23:59:59"
AND HOUR( t_start ) > 7
GROUP BY DAY, HOUR
ORDER BY HOUR( t_start ), DAYOFWEEK(t_start)
'
?>
