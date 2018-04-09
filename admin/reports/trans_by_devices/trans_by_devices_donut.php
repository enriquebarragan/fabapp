<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/trans_by_devices/trans_by_devices_sql.php');

global $mysqli;
$q = $_GET['q']; // string value passed from transaction.js

$sql_query = "";
switch ($q) {
  case 'Today':
    $sql_query = $sql_query_today;
    break;
  case 'This Week':
    $sql_query = $sql_query_this_week;
    break;
  case 'This Month':
    $sql_query = $sql_query_this_month;
    break;
  case 'This Quarter':
    $sql_query = $sql_query_this_quarter;
    break;
  case 'This Year':
    $sql_query = $sql_query_this_year;
    break;
  case 'All Time':
    $sql_query = $sql_query_all_time;
    break;
  default:
    $sql_query = $sql_query_today;
    break;
}

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
