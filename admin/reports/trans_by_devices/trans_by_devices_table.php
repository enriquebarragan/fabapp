<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');

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
