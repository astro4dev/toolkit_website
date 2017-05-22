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

$sql="SELECT * FROM topics_astr WHERE id = '".$q."'";
#$result = mysqli_query($con,$sql);

$query_topics_astr__examples = "\n
SELECT topics_astr.topics_astr,examples.last_updated,examples.title,examples.links\n
FROM topics_astr,examples,topics_astr__examples\n
WHERE topics_astr__examples.topic_id = topics_astr.id\n
AND topics_astr__examples.example_id = examples.id\n
AND topics_astr.id = '".$q."';";


$result = mysqli_query($con, $query_topics_astr__examples);

echo "<table>

<tr>
<th><div class='table-headers'>Examples</div></th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row['links'] . "\" target=\"_blank\">" . $row['title'] . "</a> - Updated on: ". $row['last_updated'] ."</td>";
    #echo "<td onclick='window.location.href = \"http://google.com\";'>" . $row['title'] . "</td>";
    echo "</tr>";
}

echo "<tr>
<th><div class='table-headers'>Courses</div></th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    #echo "<td> <a href=\"" . $row['link'] . "\">" . $row['topics_astr'] . "</a></td>";
    #echo "<td onclick='window.location.href = \"http://google.com\";'>";
    echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>
</body>
</html>