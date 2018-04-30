<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');

global $mysqli;
$dg_desc = $_GET['q'];
$start = $_GET['s'];
$end = $_GET['e'];

if($dg_desc == 'All'){
  $dg_desc = "%";
}


$sql_query = "SELECT SUM((
    SELECT count(*)
    FROM status
    WHERE transactions.status_id = status.status_id
    AND status.status_id IN (14, 20, 21, 22)
    )) AS 'Complete',
    SUM((
    SELECT count(*)
    FROM status
    WHERE transactions.status_id = status.status_id
    AND status.status_id IN (12, 15)
    )) AS 'Failed'
FROM transactions
LEFT JOIN devices ON transactions.d_id = devices.d_id
LEFT JOIN device_group ON devices.dg_id = device_group.dg_id
WHERE cast(transactions.t_start as date) BETWEEN '" . $start . "' AND '" . $end . "'
AND device_group.dg_desc LIKE '" . $dg_desc . "';
";

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
