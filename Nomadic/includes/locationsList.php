<?php

$q = intval($_GET['q']);

$result = $locations->getLocByType($q,null,null);

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['FirstName'] . "</td>";
    echo "<td>" . $row['LastName'] . "</td>";
    echo "<td>" . $row['Age'] . "</td>";
    echo "<td>" . $row['Hometown'] . "</td>";
    echo "<td>" . $row['Job'] . "</td>";
    echo "</tr>";
}
echo "</table>";


/*
$q = $_GET['location'];

$d_loc = $locations->getLocByType($q,null,null);

echo '<table  class="table table-hover"><tr class="table-disabled"><th>Name</th><th>Address</th><th>Country</th><th>Type</th></tr>';
foreach ($d_loc as $l) {
    echo '<tr onClick="locationsMap('.$l[4].",".$l[5].',17)"><td>'.$l[1].'</td><td>'.$l["address"].'</td>';?>
    <td><?php foreach ($dest as $e) { if ($l["destinations_id"]!=$e["id"]) {continue;} else {echo $e["city"].", ".$e["country"];}}?></td>
    <td><?php foreach ($cate as $e) { if ($l["location_categories_id"]!=$e["id"]) {continue;} else {echo $e["name"];}}?></td>
<?php } 
echo '</table>';
*/
?>