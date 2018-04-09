<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/failed_pie_chart/failed_pie_chart_sql.php');

global $mysqli;
$q = $_GET['q'];

/*
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
*/

$sql_query = $test;
if($result = $mysqli->query($sql_query)) {
  while($row = $result->fetch_assoc()) {
    $pie_data = "[
      ['Jobs', 'Total'],
      ['Complete', " . $row['Complete'] . "],
      ['Failed', " . $row['Failed'] . "]
      ]
      ";
      echo $pie_data;
  }
} else {
    echo mysqli_error($mysqli);
  }
?>
