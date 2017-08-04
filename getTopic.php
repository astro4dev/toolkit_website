<?php

$keyword        = $_GET['keyword'];
$author         = $_GET['author'];
$astr_topic     = $_GET['astr_topic'];

# Load user credentials
$iniData        = file_get_contents('/etc/mysql/user.cnf');
$iniData        = preg_replace('/#.*$/m', '', $iniData);
$mysqlConfig    = parse_ini_string($iniData, true);

# Connect to database
$con = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if (!empty($author)) {
# Use these queries to sort contributions by authors.
$query_author_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, language
FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments
WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND authors.name LIKE '%".$author."%');";

$query_author_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__courses.course_id, topics_astr__courses.topic_id, language
FROM authors, courses, authors__courses, topics_astr, topics_astr__courses
WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND authors.name LIKE '%".$author."%');";

$query_author_examples = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__examples.example_id, topics_astr__examples.topic_id, language
FROM authors, examples, authors__examples, topics_astr, topics_astr__examples
WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND authors.name LIKE '%".$author."%');";

$query_author = "SELECT name, affiliation, author_link, author_img, about, email
FROM authors
WHERE authors.name LIKE '%".$author."%';";
}

if (!empty($astr_topic)) {
# Use these queries to sort contributions by astronomy topic.
$query_astr_topic_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, language
FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments
WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND topics_astr.topics_astr LIKE '%".$astr_topic."%');";

$query_astr_topic_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__courses.course_id, topics_astr__courses.topic_id, language
FROM authors, courses, authors__courses, topics_astr, topics_astr__courses
WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND topics_astr.topics_astr LIKE '%".$astr_topic."%');";

$query_astr_topic_examples = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__examples.example_id, topics_astr__examples.topic_id, language
FROM authors, examples, authors__examples, topics_astr, topics_astr__examples
WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND topics_astr.topics_astr LIKE '%".$astr_topic."%');";
}

if (empty($keyword)) {
# The queries used when the Show All button is clicked
$query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, language
FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments
WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id);";

$query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__courses.course_id, topics_astr__courses.topic_id, language
FROM authors, courses, authors__courses, topics_astr, topics_astr__courses
WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id);";

$query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__examples.example_id, topics_astr__examples.topic_id, language
FROM authors, examples, authors__examples, topics_astr, topics_astr__examples
WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id);";
}

if (!empty($keyword)) {
# The queries used when a keyword is given
$query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, language
FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments
WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id)
AND IF(LENGTH('".$keyword."') > 0, assessments.title LIKE '%".$keyword."%', 0);";

$query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__courses.course_id, topics_astr__courses.topic_id, language
FROM authors, courses, authors__courses, topics_astr, topics_astr__courses
WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id)
AND IF(LENGTH('".$keyword."') > 0, courses.title LIKE '%".$keyword."%', 0);";

$query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, author_id, authors__examples.example_id, topics_astr__examples.topic_id, language
FROM authors, examples, authors__examples, topics_astr, topics_astr__examples
WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id)
AND IF(LENGTH('".$keyword."') > 0, examples.title LIKE '%".$keyword."%', 0);";
}

if (!empty($author)) {
$search_assessments = mysqli_query($con, $query_author_assessments);
$search_courses     = mysqli_query($con, $query_author_courses);
$search_examples    = mysqli_query($con, $query_author_examples);
$author_data        = mysqli_query($con, $query_author);

$contributions_assessments  = mysqli_num_rows($search_assessments);
$contributions_courses      = mysqli_num_rows($search_courses);
$contributions_examples     = mysqli_num_rows($search_examples);
}

if (!empty($astr_topic)){
$search_assessments = mysqli_query($con, $query_astr_topic_assessments);
$search_courses     = mysqli_query($con, $query_astr_topic_courses);
$search_examples    = mysqli_query($con, $query_astr_topic_examples);
}

elseif (empty($author) && empty($astr_topic)) {
$search_assessments = mysqli_query($con, $query_assessments);
$search_courses     = mysqli_query($con, $query_courses);
$search_examples    = mysqli_query($con, $query_examples);
}
    echo "<table class='alt'>";

if( mysqli_num_rows($search_examples)) {
    echo "<tr>
    <th colspan='4'>Examples:</th>
    </tr>";
    echo "<tr><td><b class=\"fa fa-language\"></b></td><td><i>Title</i></td><td><i>Astr Topic</i></td><td><b class=\"fa fa-user\"></b> Author</td></tr>";
    while($row_search_query = mysqli_fetch_array($search_examples)) {
        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        if ($row_search_query['topics_astr'] != 'no_topic') {
            echo "<td><a href=\"#\" onclick=\"catQuery('astr_topic', '" . $row_search_query['topics_astr'] . "');\"><i>" . $row_search_query['topics_astr'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }
        echo "<td><a href=\"#\" onclick=\"catQuery('author', '" . $row_search_query['name'] . "');\"><i>" . $row_search_query['name'] . "</i></a></td>";

        }
    echo "</tr>";
}

if( mysqli_num_rows($search_courses)) {
    echo "<tr>
    <th colspan='4'>Courses:</th>
    </tr>";
    echo "<tr><td><b class=\"fa fa-language\"></b></td><td><i>Title</i></td><td><i>Astr Topic</i></td><td><b class=\"fa fa-user\"></b> Author</td></tr>";
    while($row_search_query = mysqli_fetch_array($search_courses)) {
        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td> <a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
        if ($row_search_query['topics_astr'] != 'no_topic') {
            echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['topics_astr'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }
        echo "<td><a href=\"#\" onclick=\"catQuery('author', '" . $row_search_query['name'] . "');\"><i>" . $row_search_query['name'] . "</i></a></td>";
        #echo "<td><a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>#SQL</i></a> / <a href=\"" . $row_search_query['author_link'] . "\" target=\"_blank\"><i>#ASTR</i></a></td>";
        }
    echo "</tr>";
}

if( mysqli_num_rows($search_assessments) ) {
    echo "<tr>
    <th colspan='4'>Assessments:</th>
    </tr>";
    echo "<tr><td><b class=\"fa fa-language\"></b></td><td><i>Title</i></td><td><i>Astr Topic</i></td><td><b class=\"fa fa-user\"></b> Author</td></tr>";
    while($row_search_query = mysqli_fetch_array($search_assessments)) {
        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td> <a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";
         if ($row_search_query['topics_astr'] != 'no_topic') {
            echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['topics_astr'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }
        echo "<td><a href=\"#\" onclick=\"catQuery('author', '" . $row_search_query['name'] . "');\"><i>" . $row_search_query['name'] . "</i></a></td>";
        }
    echo "</tr>";
}

echo "</table>";

# Get author description array
$author       =  mysqli_fetch_array($author_data);

// Free results
mysqli_free_result($search_assessments);
mysqli_free_result($search_courses);
mysqli_free_result($search_examples);
mysqli_close($con);

if (!empty($author)) {
echo "<div class=\"column column-four\">";
echo "<h3><a href=\"" . $author['author_link'] . "\" target=\"_blank\">" . $author['name'] ."</a></h3>";
echo "<div class=\"author-info fa fa-institution\"> " . $author['affiliation'] . "</div>";
if (!empty($author['email'])) {
echo "<div class=\"author-info fa fa-envelope\"> " . $author['email'] . "</div>";
}
echo "<img src=\"" . $author['author_img'] . "\" class=\"image author\">";
echo $author['about'];
echo "<i>Contributions by " . $author['name'] ." to the toolkit:</i>";
if ($contributions_assessments != 0){
    echo "<br/>";
    if ($contributions_assessments == 1){
        echo $contributions_assessments . " Assessment";
    } else {
        echo $contributions_assessments . " Assessments";
    }
}

if ($contributions_courses != 0){
    echo "<br/>";
    if ($contributions_courses == 1){
        echo $contributions_courses . " Course";
    } else {
        echo $contributions_courses . " Courses";
    }
}

if ($contributions_examples != 0){
    echo "<br/>";
    if ($contributions_examples == 1){
        echo $contributions_examples . " Example";
    } else {
        echo $contributions_examples . " Examples";
    }
}

echo "</div>";
}


?>