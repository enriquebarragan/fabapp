<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/weekly_trans_by_hour/weekly_trans_by_hour_sql.php');

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
$day_counter = 1;
echo "[['Hour', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']";

if($result = $mysqli->query($sql_query)) {
  while($row = $result->fetch_assoc()) {
    if($day_counter == 1) {
      echo ", ['" . $row['HOUR'] . "'";
    }

      while($day_counter != $row['Day']) {
        echo ", 0";
        $day_counter = $day_counter + 1;
        if($day_counter > 7) {
          echo "], ['" . $row['HOUR'] . "'";
          $day_counter = 1;
        }
      }

      echo ", " . $row['# Tickets'];
      $day_counter = $day_counter + 1;
      if($day_counter > 7) {
        echo "]";
        $day_counter = 1;
      }
  }
  while($day_counter > 1 && $day_counter < 8) {
    echo ", 0";
    $day_counter = $day_counter + 1;
    if($day_counter > 7) {
      $day_counter = 1;
    }
  }
} else {
    echo mysqli_error($mysqli);
}

echo "]]";

?>
