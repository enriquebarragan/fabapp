<?php
include_once ($_SERVER['DOCUMENT_ROOT'].'/connections/db_connect8.php');

global $mysqli;

//string value passed from interactions.js
$q = $_GET['q'];

$sql_query = "
SELECT *
FROM `transactions`
LEFT JOIN `objbox`
ON `transactions`.`trans_id` = `objbox`.`trans_id`
LEFT JOIN `mats_used`
ON `transactions`.`trans_id` = `mats_used`.`trans_id`
WHERE `transactions`.`trans_id` = " . $q . ";
";

echo "<table class='table table-bordered table-hover table-striped'>
<thead>
        <tr>
            <th>trans_id</th>
            <th>d_id</th>
            <th>operator</th>
            <th>est_time</th>
            <th>m_id</th>
            <th>unit_used</th>
            <th>t_start</th>
            <th>t_end</th>
            <th>duration</th>
            <th>status_id</th>
						<th>total</th>
						<th>p_id</th>
						<th>staff_id</th>
						<th>o_id</th>
						<th>o_start</th>
						<th>o_end</th>
						<th>address</th>
						<th>operator</th>
						<th>trans_id</th>
						<th>staff_id</th>
						<th>mu_id</th>
						<th>trans_id</th>
						<th>m_id</th>
						<th>fil_amt</th>
						<th>unit_used</th>
						<th>date</th>
						<th>status_id</th>
						<th>operator</th>
						<th>notes</th>
						<th>mu_date</th>
						<th>staff_id</th>
						<th>mu_notes</th>
        </tr>
    </thead>
    <tbody>";

if($result = $mysqli->query($sql_query)) {
  while($row = $result->fetch_assoc()) {

    echo "<tr>";
    echo "<td>" . $row['trans_id'] . "</td>";
    echo "<td>" . $row['d_id'] . "</td>";
    echo "<td>" . $row['operator'] . "</td>";
    echo "<td>" . $row['est_time'] . "</td>";
    echo "<td>" . $row['m_id'] . "</td>";
    echo "<td>" . $row['unit_used'] . "</td>";
    echo "<td>" . $row['t_start'] . "</td>";
    echo "<td>" . $row['t_end'] . "</td>";
    echo "<td>" . $row['duration'] . "</td>";
    echo "<td>" . $row['status_id'] . "</td>";
		echo "<td>" . $row['total'] . "</td>";
		echo "<td>" . $row['p_id'] . "</td>";
		echo "<td>" . $row['staff_id'] . "</td>";
		echo "<td>" . $row['o_id'] . "</td>";
		echo "<td>" . $row['o_start'] . "</td>";
		echo "<td>" . $row['o_end'] . "</td>";
		echo "<td>" . $row['address'] . "</td>";
		echo "<td>" . $row['operator'] . "</td>";
		echo "<td>" . $row['trans_id'] . "</td>";
		echo "<td>" . $row['staff_id'] . "</td>";
		echo "<td>" . $row['mu_id'] . "</td>";
		echo "<td>" . $row['trans_id'] . "</td>";
		echo "<td>" . $row['m_id'] . "</td>";
		echo "<td>" . $row['fil_amt'] . "</td>";
		echo "<td>" . $row['unit_used'] . "</td>";
		echo "<td>" . $row['date'] . "</td>";
		echo "<td>" . $row['status_id'] . "</td>";
		echo "<td>" . $row['operator'] . "</td>";
		echo "<td>" . $row['notes'] . "</td>";
		echo "<td>" . $row['mu_date'] . "</td>";
		echo "<td>" . $row['staff_id'] . "</td>";
		echo "<td>" . $row['mu_notes'] . "</td>";
    echo "</tr>";
  }
} else {
  echo mysqli_error($mysqli);
}

echo "</tbody>
</table>";
?>
