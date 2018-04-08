<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/admin/reports/trans_by_devices/trans_by_devices_sql.php');

// This file contains all SQL statements and how they're handled

// variables
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

// prints out option
//echo $q;

echo "<table class='table table-bordered table-hover table-striped'>
<thead>
        <tr>
            <th># of Tickets</th>
            <th>3D Prints</th>
            <th>Laser</th>
            <th>Vinyl</th>
            <th>Elec Station</th>
            <th>Mill</th>
            <th>VR</th>
            <th>Sew</th>
            <th>Scan</th>
            <th>Screen Press</th>
        </tr>
    </thead>
    <tbody>";

if($result = $mysqli->query($sql_query)) {
  while($row = $result->fetch_assoc()) {

    echo "<tr>";
    echo "<td>" . $row['# of Tickets'] . "</td>";
    echo "<td>" . $row['3D Prints'] . "</td>";
    echo "<td>" . $row['Laser'] . "</td>";
    echo "<td>" . $row['Vinyl'] . "</td>";
    echo "<td>" . $row['Elec Station'] . "</td>";
    echo "<td>" . $row['Mill'] . "</td>";
    echo "<td>" . $row['VR'] . "</td>";
    echo "<td>" . $row['Sew'] . "</td>";
    echo "<td>" . $row['Scan'] . "</td>";
    echo "<td>" . $row['Screen Press'] . "</td>";
    echo "</tr>";
  }
} else {
  echo mysqli_error($mysqli);
}

echo "</tbody>
</table>";
?>
