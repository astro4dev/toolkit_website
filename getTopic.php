<?php

$keyword        = $_GET['keyword'];

# Load user credentials
$iniData        = file_get_contents('/etc/mysql/user.cnf');
$iniData        = preg_replace('/#.*$/m', '', $iniData);
$mysqlConfig    = parse_ini_string($iniData, true);

# Connect to database
$con = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

# Search and find anything in the database which matches the Id or the keyword
$query_assessments  = "SELECT assessments.title, assessments.links FROM assessments WHERE (IF(LENGTH('".$keyword."') > 0, assessments.title LIKE '%".$keyword."%', 0));";
$query_courses      = "SELECT courses.title, courses.links FROM courses WHERE (IF(LENGTH('".$keyword."') > 0, courses.title LIKE '%".$keyword."%', 0));";
$query_examples     = "SELECT examples.title, examples.links FROM examples WHERE (IF(LENGTH('".$keyword."') > 0, examples.title LIKE '%".$keyword."%', 0));";

$query_author       = "SELECT authors.name FROM authors, authors__examples, examples WHERE authors__examples.author_id = authors.id AND authors__examples.example_id = examples.id AND examples.title LIKE '%".$keyword."%';";

$search_assessments = mysqli_query($con, $query_assessments);
$search_courses     = mysqli_query($con, $query_courses);
$search_examples    = mysqli_query($con, $query_examples);

$search_author    = mysqli_query($con, $query_author );


    echo "<table>";


if( mysqli_num_rows($search_examples) ) {
    echo "<tr>
    <th colspan='2'>Examples:</th>
    </tr>";
    while($row_search_query = mysqli_fetch_array($search_examples)) {
        echo "<tr><td> <a href=\"" . $row_search_query[1] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        }
    echo "</tr>";
}

if( mysqli_num_rows($search_courses) ) {
    echo "<tr>
    <th colspan='2'>Courses:</th>
    </tr>";
    while($row_search_query = mysqli_fetch_array($search_courses)) {
        echo "<tr><td> <a href=\"" . $row_search_query[1] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        }
    echo "</tr>";
}

if( mysqli_num_rows($search_assessments) ) {
    echo "<tr>
    <th colspan='2'>Assessments:</th>
    </tr>";
    while($row_search_query = mysqli_fetch_array($search_assessments)) {
        echo "<tr><td> <a href=\"" . $row_search_query[1] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        }
    echo "</tr>";
}

echo "</table>";

// Free results
/*mysqli_free_result($example_astr);
mysqli_free_result($example_skill);
mysqli_free_result($course_astr);
mysqli_free_result($course_skill);
mysqli_free_result($assessment_skill);
mysqli_free_result($search_query);
*/
mysqli_close($con);
?>