<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
//include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/trans_by_devices/trans_by_devices_sql.php');

global $mysqli;

//string value passed from interactions.js
$start_date = $_GET['s'];
$end_date = $_GET['e'];

$sql_query = "
SELECT
	SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "')) as '# of Tickets',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE 'Polyprinter%')) as '3D Prints',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Laser')) as 'Laser',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Vinyl%')) as 'Vinyl',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE 'Elec%')) as 'Elec Station',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Mill')) as 'Mill',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Rift')) as 'VR',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Sewing%')) as 'Sew',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Scanner%')) as 'Scan',
    SUM((SELECT COUNT(trans_id)
         FROM transactions
         WHERE devices.device_id = transactions.d_id
         AND cast(transactions.t_start as date) BETWEEN
         '" . $start_date . "' AND '" . $end_date . "'
         AND device_desc LIKE '%Screen%')) as 'Screen Press'
FROM devices;
";

if($result = $mysqli->query($sql_query)) {
  while($row = $result->fetch_assoc()) {

    $donut_data = '[
    {label: "3D Prints", value: ' . $row["3D Prints"] . ' },
    {label: "Laser", value: ' . $row["Laser"] . ' },
    {label: "Vinyl", value: ' . $row["Vinyl"] . ' },
    {label: "Elec Station", value: ' . $row["Elec Station"] . ' },
    {label: "Mill", value: ' . $row["Mill"] . ' },
    {label: "VR", value: ' . $row["VR"] . ' },
    {label: "Sew", value: ' . $row["Sew"] . ' },
    {label: "Scan", value: ' . $row["Scan"] . ' },
    {label: "Screen Press", value: ' . $row["Screen Press"] . ' }
    ]';
    echo $donut_data;
  }
} else {
    echo mysqli_error($mysqli);
  }
?>
