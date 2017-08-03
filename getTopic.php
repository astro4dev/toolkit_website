<?php

$keyword        = $_GET['keyword'];
$author         = $_GET['author'];
#$show           = 'courses';#$_GET['show'];

# Load user credentials
$iniData        = file_get_contents('/etc/mysql/user.cnf');
$iniData        = preg_replace('/#.*$/m', '', $iniData);
$mysqlConfig    = parse_ini_string($iniData, true);

# Connect to database
$con = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if (empty($keyword)) {
$query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, author_id, assessment_id, language FROM authors, assessments, authors__assessments WHERE (authors.id=author_id AND assessments.Id = assessment_id);";
$query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, author_id, course_id, language FROM authors, courses, authors__courses WHERE (authors.id=author_id AND courses.Id = course_id);";
$query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, author_id, example_id, language FROM authors, examples, authors__examples WHERE (authors.id=author_id AND examples.Id = example_id);";
}
else {
$query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, author_id, assessment_id, language FROM authors, assessments, authors__assessments WHERE (authors.id=author_id AND assessments.Id = assessment_id) AND (IF(LENGTH('".$keyword."') > 0, assessments.title LIKE '%".$keyword."%', 0));";
$query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, author_id, course_id, language FROM authors, courses, authors__courses WHERE (authors.id=author_id AND courses.Id = course_id) AND (IF(LENGTH('".$keyword."') > 0, courses.title LIKE '%".$keyword."%', 0));";
$query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, author_id, example_id, language FROM authors, examples, authors__examples WHERE (authors.id=author_id AND examples.Id = example_id) AND (IF(LENGTH('".$keyword."') > 0, examples.title LIKE '%".$keyword."%', 0));";
}

$search_assessments = mysqli_query($con, $query_assessments);
$search_courses     = mysqli_query($con, $query_courses);
$search_examples    = mysqli_query($con, $query_examples);

    echo "<table class='alt'>";

if( mysqli_num_rows($search_examples)) {
    echo "<tr>
    <th colspan='3'>Examples:".$show."</th>
    </tr>";
    echo "<tr><td><i>Language</i></td><td><i>Title</i></td><td><i>Author</i></td></tr>";
    while($row_search_query = mysqli_fetch_array($search_examples)) {
        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        echo "<td><a href=\"#\" onclick=\"catQuery('keyword', 'Exo');\"><i>" . $row_search_query['name'] . "</i></a></td>";

        }
    echo "</tr>";
}

if( mysqli_num_rows($search_courses)) {
    echo "<tr>
    <th colspan='3'>Courses:</th>
    </tr>";
    echo "<tr><td><i>Language</i></td><td><i>Title</i></td><td><i>Author</i></td></tr>";
    while($row_search_query = mysqli_fetch_array($search_courses)) {
        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td> <a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>" . $row_search_query['name'] . "</i></a></td>";
        #echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>#SQL</i></a> / <a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>#ASTR</i></a></td>";
        }
    echo "</tr>";
}

if( mysqli_num_rows($search_assessments) ) {
    echo "<tr>
    <th colspan='3'>Assessments:</th>
    </tr>";
    echo "<tr><td><i>Language</i></td><td><i>Title</i></td><td><i>Author</i></td></tr>";
    while($row_search_query = mysqli_fetch_array($search_assessments)) {
        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td> <a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>" . $row_search_query['name'] . "</i></a></td>";
        }
    echo "</tr>";
}

echo "</table>";


// Free results
mysqli_free_result($search_assessments);
mysqli_free_result($search_courses);
mysqli_free_result($search_examples);

mysqli_close($con);
?>