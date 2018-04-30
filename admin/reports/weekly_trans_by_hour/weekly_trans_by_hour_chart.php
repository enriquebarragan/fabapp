<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/functions.php');

global $mysqli;
$q = $_GET['q'];

$todays_date = new DateTime($q); // test date value (delete this in prod)
$current_date_details = get_year_month_week($todays_date->format('Y-m-d'));
$week_array = get_week_start_end($current_date_details['week'], $current_date_details['year']);

$sql_query = '
SELECT
DAYOFWEEK(t_start) AS Day,
HOUR( t_start ) AS HOUR,
COUNT( HOUR( t_start ) ) AS  "# Tickets"
FROM transactions
WHERE  t_start BETWEEN ' . $week_array['week_start'] . ' AND ' . $week_array['week_end'] . '
AND HOUR( t_start ) > 7
GROUP BY DAY, HOUR
ORDER BY HOUR( t_start ), DAYOFWEEK(t_start)
';

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
