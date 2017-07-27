<?php

$keyword        = $_GET['keyword'];
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

$query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, author_id, assessment_id FROM authors, assessments, authors__assessments WHERE (authors.id=author_id AND assessments.Id = assessment_id) AND (IF(LENGTH('".$keyword."') > 0, assessments.title LIKE '%".$keyword."%', 0));";
$query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, author_id, course_id FROM authors, courses, authors__courses WHERE (authors.id=author_id AND courses.Id = course_id) AND (IF(LENGTH('".$keyword."') > 0, courses.title LIKE '%".$keyword."%', 0));";
$query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, author_id, example_id FROM authors, examples, authors__examples WHERE (authors.id=author_id AND examples.Id = example_id) AND (IF(LENGTH('".$keyword."') > 0, examples.title LIKE '%".$keyword."%', 0));";

$query_all_courses = "SELECT title, name, author_link, links FROM courses, authors, authors__courses WHERE (authors.id=author_id AND courses.Id = course_id);";

$search_assessments = mysqli_query($con, $query_assessments);
$search_courses     = mysqli_query($con, $query_courses);
$search_examples    = mysqli_query($con, $query_examples);

    echo "<table>";

if( mysqli_num_rows($search_examples)) {
    echo "<tr>
    <th colspan='2'>Examples:".$show."</th>
    </tr>";
    while($row_search_query = mysqli_fetch_array($search_examples)) {
        echo "<tr><td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>" . $row_search_query['name'] . "</i></a></td>";
        }
    echo "</tr>";
}

#<img src='" . $row_search_query['author_img'] . "' width='60'>

if( mysqli_num_rows($search_courses)) {
    echo "<tr>
    <th colspan='2'>Courses:</th>
    </tr>";
    while($row_search_query = mysqli_fetch_array($search_courses)) {
        echo "<tr><td> <a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>" . $row_search_query['name'] . "</i></a></td>";
        #echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>#SQL</i></a> / <a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>#ASTR</i></a></td>";
        }
    echo "</tr>";
}

if( mysqli_num_rows($search_assessments) ) {
    echo "<tr>
    <th colspan='2'>Assessments:</th>
    </tr>";
    while($row_search_query = mysqli_fetch_array($search_assessments)) {
        echo "<tr><td> <a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
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


<!-- Work in progress
<script type="text/javascript">

    var text = 'courses'

    function loadXMLDoc()
    {
        var xmlhttp;
        if (window.XMLHttpRequest)
        {
            xmlhttp = new XMLHttpRequest();
        }
        else
        {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function()
        {
            if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                // do something if the page loaded successfully
            }
        }
        xmlhttp.open("GET","getTopic.php?show="+text,true);
        xmlhttp.send();
    }
</script>
-->