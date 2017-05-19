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

# Load user credentials
$iniData        = file_get_contents('/etc/mysql/user.cnf');
$iniData        = preg_replace('/#.*$/m', '', $iniData);
$mysqlConfig    = parse_ini_string($iniData, true);

# Connect to database
$con = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"topics_astr");

$sql="SELECT * FROM topics_astr WHERE id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>

<tr>
<th><div class='table-headers'>Examples</div></th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['topics_astr'] . "</td>";
    echo "</tr>";
}

echo "<tr>
<th><div class='table-headers'>Courses</div></th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['topics_astr'] . "</td>";
    echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>
</body>
</html>