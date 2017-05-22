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
$astr_choice = intval($_GET['astr_choice']);
$ds_choice   = intval($_GET['ds_choice']);
#$q = intval($_GET['q']);

# Load user credentials
$iniData        = file_get_contents('/etc/mysql/user.cnf');
$iniData        = preg_replace('/#.*$/m', '', $iniData);
$mysqlConfig    = parse_ini_string($iniData, true);

# Connect to database
$con = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$query_topics_astr__examples = "\n
SELECT topics_astr.topics_astr,examples.last_updated,examples.title,examples.links\n
FROM topics_astr,examples,topics_astr__examples\n
WHERE topics_astr__examples.topic_id = topics_astr.id\n
AND topics_astr__examples.example_id = examples.id\n
AND topics_astr.id = '".$astr_choice."';";

$query_skills__examples = "\n
SELECT skills.skills,examples.last_updated,examples.title,examples.links\n
FROM skills,examples,skills__examples\n
WHERE skills__examples.skill_id = skills.id\n
AND skills__examples.example_id = examples.id\n
AND skills.id = '".$ds_choice."';";


$example    = mysqli_query($con, $query_topics_astr__examples);
$skill      = mysqli_query($con, $query_skills__examples);

echo "<table>

<tr>
<th><div class='table-headers'>Examples</div></th>
</tr>";
while($row_example = mysqli_fetch_array($example)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row_example['links'] . "\" target=\"_blank\">" . $row_example['title'] . "</a> - Updated on: ". $row_example['last_updated'] ."</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td> <a href=\"" . $row_skill['links'] . "\" target=\"_blank\">" . $row_skill['title'] . "</a> - Updated on: ". $row_skill['last_updated'] ."</td>";
    echo "</tr>";
}

echo "<tr>
<th><div class='table-headers'>Courses</div></th>
</tr>";
while($row_skill = mysqli_fetch_array($skill)) {
    echo "<tr>";
    #echo "<td> <a href=\"" . $row_skill['links'] . "\" target=\"_blank\">" . $row_skill['title'] . "</a> - Updated on: ". $row_skill['last_updated'] ."</td>";
    #echo "<td onclick='window.location.href = \"http://google.com\";'>" . $row['title'] . "</td>";
    echo "</tr>";
}

echo "</table>";
mysqli_close($con);
?>
</body>
</html>