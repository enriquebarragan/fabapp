<?php
//include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/functions.php');

// This file contains all SQL statements and how they're handled

// variables
//global $mysqli;
//$q = $_GET['q']; // string value passed from transaction.js
$todays_date = new DateTime('2018-01-18'); // test date value (delete this in prod)
//$todays_date = new DateTime(date("Y-m-d")); //uncomment to get today's date
$current_date_details = get_year_month_week($todays_date->format('Y-m-d'));
$week_array = get_week_start_end($current_date_details['week'], $current_date_details['year']);
$quarter = get_quarter($todays_date);
$dates_as_strings['today'] = date_to_sqldate($todays_date);

// queries
$sql_query_today = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > " . $dates_as_strings['today'] . "
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > " . $dates_as_strings['today'] . "
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_week = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end']. "
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start >" . $week_array['week_start'] . "AND t_start <" . $week_array['week_end'] . "
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_month = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-" . $current_date_details['month'] . "-" . $current_date_details['days'] . "'
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_quarter = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > " . $quarter['q_start'] . "
    AND t_start < " . $quarter['q_end'] . "
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_year = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > '" . $current_date_details['year'] . "-01-01'" . "
    AND t_start < '" . $current_date_details['year'] . "-12-31'" . "
    )) as 'Screen Press'
FROM devices;
";

$sql_query_all_time = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    )) as 'Screen Press'
FROM devices;
";
?>
