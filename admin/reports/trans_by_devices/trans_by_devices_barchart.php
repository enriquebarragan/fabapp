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
    $bar_data = '[
      { y: "# of Tickets", a: ' . $row["# of Tickets"] . '},
      { y: "3D Prints", a: ' . $row["3D Prints"] . '},
      { y: "Laser", a: ' . $row["Laser"] . '},
      { y: "Vinyl", a: ' . $row["Vinyl"] . '},
      { y: "Elec Station", a: ' . $row["Elec Station"] . ' },
      { y: "Mill", a: ' . $row["Mill"] . ' },
      { y: "VR", a: ' . $row["VR"] . '},
      { y: "Sew", a: ' . $row["Sew"] . '},
      { y: "Scan", a: ' . $row["Scan"] . '},
      { y: "Screen Pess", a: ' . $row["Screen Press"] . '}
    ]';
    echo $bar_data;
    /*echo "[ { y: '# of Tickets', a: 100},
    { y: '3D Prints', a: 75},
    { y: 'Laser', a: 50},
    { y: 'Vinyl', a: 75},
    { y: 'Elec Station', a: 50 },
    { y: 'Mill', a: 75 },
    { y: 'VR', a: 100},
    { y: 'Sew', a: 130},
    { y: 'Scan', a: 20},
    { y: 'Screen Pess', a: 100}
    ]";*/
    //echo json_encode('test');
  }
} else {
    echo mysqli_error($mysqli);
  }

/*

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

new Morris.Bar({
  element: 'trans_by_devices_barchart',
  data: [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 75,  b: 65 },
    { y: '2012', a: 100, b: 90 }
  ],
  xkey: 'y',
  ykeys: ['a', 'b'],
  labels: ['Series A', 'Series B']
}); */
?>
