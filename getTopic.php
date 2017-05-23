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
    font-size: 16px;
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

$query_topics_astr__courses = "\n
SELECT topics_astr.topics_astr,courses.last_updated,courses.title,courses.links\n
FROM topics_astr,courses,topics_astr__courses\n
WHERE topics_astr__courses.topic_id = topics_astr.id\n
AND topics_astr__courses.course_id = courses.id\n
AND topics_astr.id = '".$astr_choice."';";

$query_skills__courses = "\n
SELECT skills.skills,courses.last_updated,courses.title,courses.links\n
FROM skills,courses,skills__courses\n
WHERE skills__courses.skill_id = skills.id\n
AND skills__courses.course_id = courses.id\n
AND skills.id = '".$ds_choice."';";

$query_skills__assessments = "\n
SELECT skills.skills,assessments.last_updated,assessments.title,assessments.links\n
FROM skills,assessments,skills__assessments\n
WHERE skills__assessments.skill_id = skills.id\n
AND skills__assessments.assessment_id = assessments.id\n
AND skills.id = '".$ds_choice."';";

$example_astr    = mysqli_query($con, $query_topics_astr__examples);
$example_skill   = mysqli_query($con, $query_skills__examples);

$course_astr     = mysqli_query($con, $query_topics_astr__courses);
$course_skill    = mysqli_query($con, $query_skills__courses);

$assessment_skill= mysqli_query($con, $query_skills__assessments);

echo "<table>

<tr>
<th><div class='table-headers'>Examples</div></th>
</tr>";
while($row_example_astr = mysqli_fetch_array($example_astr)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row_example_astr['links'] . "\" target=\"_blank\">" . $row_example_astr['title'] . "</a> - Updated on: ". $row_example_astr['last_updated'] ."</td>";
    echo "</tr>";}
while($row_example_skill = mysqli_fetch_array($example_skill)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row_example_skill['links'] . "\" target=\"_blank\">" . $row_example_skill['title'] . "</a> - Updated on: ". $row_example_skill['last_updated'] . "</td>";
    echo "</tr>";}

echo "<tr>
<th><div class='table-headers'>Courses</div></th>
</tr>";
while($row_course_astr = mysqli_fetch_array($course_astr)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row_course_astr['links'] . "\" target=\"_blank\">" . $row_course_astr['title'] . "</a> - Updated on: ". $row_course_astr['last_updated'] ."</td>";
    echo "</tr>";}
while($row_course_skill = mysqli_fetch_array($course_skill)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row_course_skill['links'] . "\" target=\"_blank\">" . $row_course_skill['title'] . "</a> - Updated on: ". $row_course_skill['last_updated'] ."</td>";
    echo "</tr>";}

echo "<tr>
<th><div class='table-headers'>Assessments</div></th>
</tr>";
while($row_assessment_skill = mysqli_fetch_array($assessment_skill)) {
    echo "<tr>";
    echo "<td> <a href=\"" . $row_assessment_skill['links'] . "\" target=\"_blank\">" . $row_assessment_skill['title'] . "</a> - Updated on: ". $row_assessment_skill['last_updated'] ."</td>";
    echo "</tr>";}

echo "</table>";
mysqli_close($con);
?>
</body>
</html>