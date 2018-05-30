<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);




















$con = mysqli_connect('127.0.0.1','root','124123','dierenambulance');
if (!$con) {
    echo . mysqli_connect_erno() . PHP_EOL;
}

mysqli_select_db($con,"dierenambulance");
$sql="SELECT * FROM knowns WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>Locatie</th>
<th>Postcode</th>
<th>Adres</th>
<th>Huisnummer</th>
<th>Plaats</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['location_name'] . "</td>";
    echo "<td>" . $row['postal_code'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['house_number'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>