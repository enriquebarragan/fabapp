<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');
global $mysqli;
$q = $_GET['q'];
$todays_date = "2018-01-18";

function getStartAndEndDate($week, $year) {
  $dto = new DateTime();
  $dto->setISODate($year, $week);
  $ret['week_start'] = $dto->format('Y-m-d');
  $dto->modify('+6 days');
  $ret['week_end'] = $dto->format('Y-m-d');
  return $ret;
}

$date = new DateTime($todays_date);
$week = $date->format("W");
$year = $date->format("Y");
$week_array = getStartAndEndDate($week,$year);

$todays_date = "'2018-01-18'";
// uncomment this to use today's date
//$todays_date = "'".date("Y-m-d")."'";

// option
echo $q;

// queries
$sql_query_today = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > " . $todays_date . "
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > " . $todays_date . "
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > " . $todays_date . "
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > " . $todays_date . "
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > " . $todays_date . "
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > " . $todays_date . "
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > " . $todays_date . "
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > " . $todays_date . "
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > " . $todays_date . "
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > " . $todays_date . "
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_week = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > '2018-01-15' AND t_start < '2018-01-21'
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_month = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > '2018-01-01' AND t_start < '2018-01-31'
    )) as 'Screen Press'
FROM devices;
";

$sql_query_this_semsester = "
SELECT
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE devices.device_id = transactions.d_id
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as '# of Tickets',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Polyprinter%'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as '3D Prints',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Laser'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'Laser',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Vinyl%'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'Vinyl',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE 'Elec%'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'Elec Station',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Mill'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'Mill',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Rift'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'VR',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Sewing%'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'Sew',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Scanner%'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
    )) as 'Scan',
    SUM((
    SELECT COUNT(trans_id)
    FROM transactions
    WHERE transactions.d_id = devices.device_id
    AND device_desc LIKE '%Screen%'
    AND t_start > '2018-01-16' AND t_start < '2018-01-31'
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
  case 'This Semester':
    $sql_query = $sql_query_this_semsester;
    break;
  case 'This Year':
    //change this. only like this to save time.
    $sql_query = $sql_query_this_month;
    break;
  case 'All Time':
    $sql_query = $sql_query_all_time;
    break;
  default:
    $sql_query = $sql_query_today;
    break;
}

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
