<!--
getTopic.php - This is the heart of toolkit. The file which requests information from the
database. It starts of by getting the variables from toolkit.php. Then opens a connection
to the database. Then issues the SQL queries.

The file creates a table with the search results and also provides the user with author
information if their name is clicked.
-->

<?php
# Loading variables from toolkit.php given by 
$keyword        = $_GET['keyword'];
$author         = $_GET['author'];
$skills         = $_GET['skills'];
$astr_topic     = $_GET['astr_topic'];

# Loading user credentials to be able to connect to the datbase
# NEVER hard code your password into a PHP file.
$iniData        = file_get_contents('/etc/mysql/user.cnf');
$iniData        = preg_replace('/#.*$/m', '', $iniData);
$mysqlConfig    = parse_ini_string($iniData, true);

# Connect to database
$con = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

# If the connection fails show the reason why
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}


if (!empty($author)) {
# This query lists work done by a particular author and orders it by title.
    $query_author_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, skills__assessments.skill_id, language
    FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments, skills, skills__assessments
    WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND skills.Id=skills__assessments.skill_id AND assessments.Id = skills__assessments.assessment_id AND authors.name LIKE '%".$author."%') ORDER BY title;";

    $query_author_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__courses.course_id, topics_astr__courses.topic_id, skills__courses.skill_id, language
    FROM authors, courses, authors__courses, topics_astr, topics_astr__courses, skills, skills__courses
    WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND skills.Id=skills__courses.skill_id AND courses.Id = skills__courses.course_id AND authors.name LIKE '%".$author."%') ORDER BY title;";

    $query_author_examples = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__examples.example_id, topics_astr__examples.topic_id, skills__examples.skill_id, language
    FROM authors, examples, authors__examples, topics_astr, topics_astr__examples, skills, skills__examples
    WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND skills.Id=skills__examples.skill_id AND examples.Id = skills__examples.example_id AND authors.name LIKE '%".$author."%') ORDER BY title;";

    $query_author = "SELECT name, affiliation, author_link, author_img, about, email
    FROM authors
    WHERE authors.name LIKE '%".$author."%';";
}


if (!empty($skills)) {
# This query lists all results which match a selected skill and orders it by title.
    $query_skills_assessments = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, skills__assessments.skill_id, language
    FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments, skills, skills__assessments
    WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND skills.Id=skills__assessments.skill_id AND assessments.Id = skills__assessments.assessment_id AND skills.skills = '".$skills."') ORDER BY title;";

    $query_skills_courses = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__courses.course_id, topics_astr__courses.topic_id, skills__courses.skill_id, language
    FROM authors, courses, authors__courses, topics_astr, topics_astr__courses, skills, skills__courses
    WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND skills.Id=skills__courses.skill_id AND courses.Id = skills__courses.course_id AND skills.skills = '".$skills."') ORDER BY title;";

    $query_skills_examples = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__examples.example_id, topics_astr__examples.topic_id, skills__examples.skill_id, language
    FROM authors, examples, authors__examples, topics_astr, topics_astr__examples, skills, skills__examples
    WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND skills.Id=skills__examples.skill_id AND examples.Id = skills__examples.example_id AND skills.skills = '".$skills."') ORDER BY title;";
}

if (!empty($astr_topic)) {
# This query lists all results which match a selected astronomy topic and orders it by title.
    $query_astr_topic_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, skills__assessments.skill_id, language
    FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments, skills, skills__assessments
    WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND skills.Id=skills__assessments.skill_id AND assessments.Id = skills__assessments.assessment_id AND topics_astr.topics_astr LIKE '%".$astr_topic."%') ORDER BY title;";

    $query_astr_topic_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__courses.course_id, topics_astr__courses.topic_id, skills__courses.skill_id, language
    FROM authors, courses, authors__courses, topics_astr, topics_astr__courses, skills, skills__courses
    WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND skills.Id=skills__courses.skill_id AND courses.Id = skills__courses.course_id AND topics_astr.topics_astr LIKE '%".$astr_topic."%') ORDER BY title;";

    $query_astr_topic_examples = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__examples.example_id, topics_astr__examples.topic_id, skills__examples.skill_id, language
    FROM authors, examples, authors__examples, topics_astr, topics_astr__examples, skills, skills__examples
    WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND skills.Id=skills__examples.skill_id AND examples.Id = skills__examples.example_id AND topics_astr.topics_astr LIKE '%".$astr_topic."%') ORDER BY title;";
}


if (!empty($keyword)) {
# This query lists all results which match the given keyword and orders it by title.
    $query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, skills__assessments.skill_id, language
    FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments, skills, skills__assessments
    WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND skills.Id=skills__assessments.skill_id AND assessments.Id = skills__assessments.assessment_id AND IF(LENGTH('".$keyword."') > 0, assessments.title LIKE '%".$keyword."%' OR topics_astr.topics_astr LIKE '%".$keyword."%' OR skills.skills LIKE '%".$keyword."%', 0)) ORDER BY title;";

    $query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__courses.course_id, topics_astr__courses.topic_id, skills__courses.skill_id, language
    FROM authors, courses, authors__courses, topics_astr, topics_astr__courses, skills, skills__courses
    WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND skills.Id=skills__courses.skill_id AND courses.Id = skills__courses.course_id AND IF(LENGTH('".$keyword."') > 0, courses.title LIKE '%".$keyword."%' OR topics_astr.topics_astr LIKE '%".$keyword."%' OR skills.skills LIKE '%".$keyword."%', 0)) ORDER BY title;";

    $query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__examples.example_id, topics_astr__examples.topic_id, skills__examples.skill_id, language
    FROM authors, examples, authors__examples, topics_astr, topics_astr__examples, skills, skills__examples
    WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND skills.Id=skills__examples.skill_id AND examples.Id = skills__examples.example_id AND IF(LENGTH('".$keyword."') > 0, examples.title LIKE '%".$keyword."%' OR topics_astr.topics_astr LIKE '%".$keyword."%' OR skills.skills LIKE '%".$keyword."%', 0)) ORDER BY title;";
}


if (empty($keyword)) {
# The queries used when the Show All button is clicked. Bascially show the entire toolkit.
    $query_assessments  = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__assessments.assessment_id, topics_astr__assessments.topic_id, skills__assessments.skill_id, language
    FROM authors, assessments, authors__assessments, topics_astr, topics_astr__assessments, skills, skills__assessments
    WHERE (authors.Id=author_id AND assessments.Id = authors__assessments.assessment_id AND topics_astr.Id=topics_astr__assessments.topic_id AND assessments.Id = topics_astr__assessments.assessment_id AND skills.Id=skills__assessments.skill_id AND assessments.Id = skills__assessments.assessment_id) ORDER BY title;";

    $query_courses      = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__courses.course_id, topics_astr__courses.topic_id, skills__courses.skill_id, language
    FROM authors, courses, authors__courses, topics_astr, topics_astr__courses, skills, skills__courses
    WHERE (authors.Id=author_id AND courses.Id = authors__courses.course_id AND topics_astr.Id=topics_astr__courses.topic_id AND courses.Id = topics_astr__courses.course_id AND skills.Id=skills__courses.skill_id AND courses.Id = skills__courses.course_id) ORDER BY title;";

    $query_examples     = "SELECT title, name, affiliation, author_link, author_img, links, topics_astr, skills, author_id, authors__examples.example_id, topics_astr__examples.topic_id, skills__examples.skill_id, language
    FROM authors, examples, authors__examples, topics_astr, topics_astr__examples, skills, skills__examples
    WHERE (authors.Id=author_id AND examples.Id = authors__examples.example_id AND topics_astr.Id=topics_astr__examples.topic_id AND examples.Id = topics_astr__examples.example_id AND skills.Id=skills__examples.skill_id AND examples.Id = skills__examples.example_id) ORDER BY title;";
}


# Perform the actually queries using the above constructed SQL queries.
if (!empty($author)) {
    $search_assessments = mysqli_query($con, $query_author_assessments);
    $search_courses     = mysqli_query($con, $query_author_courses);
    $search_examples    = mysqli_query($con, $query_author_examples);
    $author_data        = mysqli_query($con, $query_author);
}

if (!empty($astr_topic)){
    $search_assessments = mysqli_query($con, $query_astr_topic_assessments);
    $search_courses     = mysqli_query($con, $query_astr_topic_courses);
    $search_examples    = mysqli_query($con, $query_astr_topic_examples);
}

if (!empty($skills)){
    $search_assessments = mysqli_query($con, $query_skills_assessments);
    $search_courses     = mysqli_query($con, $query_skills_courses);
    $search_examples    = mysqli_query($con, $query_skills_examples);
}

elseif (empty($author) && empty($astr_topic) && empty($skills)){
    $search_assessments = mysqli_query($con, $query_assessments);
    $search_courses     = mysqli_query($con, $query_courses);
    $search_examples    = mysqli_query($con, $query_examples);
}

# Create the table of results.
if( mysqli_num_rows($search_examples)) {
    echo "<table class='alt'>";
    echo "<tr>
    <th colspan='6'>Examples:</th>
    </tr>";
    echo "<tr>
    <td><b class=\"fa fa-language\"></b></td>
    <td><b class=\"fa  fa-chevron-right\"></b> Title</td>
    <td><b class=\"fa fa-user\"></b> Author</td>
    <td><b class=\"fa fa-star\"></b> Astro Topic</td>
    <td colspan='2'><b class=\"fa fa-code\"></b> Skills</td>
    </tr>";
while($row_search_query = mysqli_fetch_array($search_examples)) {

    if ($topic_dummy_examples != $row_search_query['title']) {

        $topic_dummy_examples   = $row_search_query['title'];
        $skill_dummy_examples   = $row_search_query['skills'];

        # Language
        echo "<tr><td>". $row_search_query['language'] . "</td>";

        # Title
        echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";

        # Author name
        echo "<td><a href=\"#\" onclick=\"catQuery('author', '" . $row_search_query['name'] . "');\"><i>" . $row_search_query['name'] . "</i></a></td>";

        # Astronomy topic
        if ($row_search_query['topics_astr'] != 'no_topic') {
            echo "<td><a href=\"#\" onclick=\"catQuery('astr_topic', '" . $row_search_query['topics_astr'] . "');\"><i>" . $row_search_query['topics_astr'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }

        # Data Science Skill #1
        echo "<td><a href=\"#\" onclick=\"catQuery('skills', '" . $row_search_query['skills'] . "');\"><i>" . $row_search_query['skills'] . "</i></a></td>";
    }

    else {
        # Data Science Skill #2 (if it exists)
        echo "<td>/ <a href=\"#\" onclick=\"catQuery('skills', '" . $row_search_query['skills'] . "');\"><i>" . $row_search_query['skills'] . "</i></a></td>";
        }

}

echo "</tr>";
echo "</table>";
}


if( mysqli_num_rows($search_courses)) {
    echo "<table class='alt'>";
    echo "<tr>
    <th colspan='6'>Courses:</th>
    </tr>";
    echo "<tr>
    <td><b class=\"fa fa-language\"></b></td>
    <td><b class=\"fa  fa-chevron-right\"></b> Title</td>
    <td><b class=\"fa fa-user\"></b> Author</td>
    <td><b class=\"fa fa-star\"></b> Astro Topic</td>
    <td colspan='2'><b class=\"fa fa-code\"></b> Skills</td>
    </tr>";
while($row_search_query = mysqli_fetch_array($search_courses)) {

    if ($topic_dummy_courses != $row_search_query['title']) {

        $topic_dummy_courses    = $row_search_query['title'];
        $skill_dummy_courses    = $row_search_query['skills'];

        # Language
        echo "<tr><td>". $row_search_query['language'] . "</td>";

        # Title
        echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";

        # Author name
        echo "<td><a href=\"#\" onclick=\"catQuery('author', '" . $row_search_query['name'] . "');\"><i>" . $row_search_query['name'] . "</i></a></td>";

        # Astronomy topic
        if ($row_search_query['topics_astr'] != 'no_topic') {
            echo "<td><a href=\"#\" onclick=\"catQuery('astr_topic', '" . $row_search_query['topics_astr'] . "');\"><i>" . $row_search_query['topics_astr'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }

        # Data Science Skill #1
        echo "<td><a href=\"#\" onclick=\"catQuery('skills', '" . $row_search_query['skills'] . "');\"><i>" . $row_search_query['skills'] . "</i></a></td>";
    }

    else {
        # Data Science Skill #2 (if it exists)
        echo "<td>/ <a href=\"#\" onclick=\"catQuery('skills', '" . $row_search_query['skills'] . "');\"><i>" . $row_search_query['skills'] . "</i></a></td>";
        }

}

echo "</tr>";
echo "</table>";
}


if( mysqli_num_rows($search_assessments) ) {
    echo "<table class='alt'>";
    echo "<tr>
    <th colspan='6'>Assessments:</th>
</tr>";
echo "<tr>
<td><b class=\"fa fa-language\"></b></td>
<td><b class=\"fa  fa-chevron-right\"></b> Title</td>
<td><b class=\"fa fa-user\"></b> Author</td>
<td><b class=\"fa fa-star\"></b> Astro Topic</td>
<td colspan='2'><b class=\"fa fa-code\"></b> Skills</td>
</tr>";
while($row_search_query = mysqli_fetch_array($search_assessments)) {

    if ($topic_dummy_assessments != $row_search_query['title']) {

        $topic_dummy_assessments = $row_search_query['title'];


        echo "<tr><td>". $row_search_query['language'] . "</td>";
        echo "<td><a href=\"" . $row_search_query['links'] . "\" target=\"_blank\"><i>" . $row_search_query['title'] . "</i></a></td>";

        echo "<td><a href=\"#\" onclick=\"catQuery('author', '" . $row_search_query['name'] . "');\"><i>" . $row_search_query['name'] . "</i></a></td>";

        # Astronomy topics
        if ($row_search_query['topics_astr'] != 'no_topic') {
            echo "<td><a href=\"#\" onclick=\"catQuery('astr_topic', '" . $row_search_query['topics_astr'] . "');\"><i>" . $row_search_query['topics_astr'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }

        # Data Science Skills
        if ($row_search_query['skills'] != 'no_topic') {
            $skill_dummy = $row_search_query['skills'];
            echo "<td><a href=\"#\" onclick=\"catQuery('skills', '" . $row_search_query['skills'] . "');\"><i>" . $row_search_query['skills'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }

    }

    else{
        if ($skill_dummy != $row_search_query['skills']){
            echo "<td>/ <a href=\"#\" onclick=\"catQuery('skills', '" . $row_search_query['skills'] . "');\"><i>" . $row_search_query['skills'] . "</i></a></td>";
        } else {
            echo "<td></td>";
        }
    }

}

echo "</tr>";
echo "</table>";
}



# Get author description array
$author       =  mysqli_fetch_array($author_data);

// Free memory from the queries
mysqli_free_result($search_assessments);
mysqli_free_result($search_courses);
mysqli_free_result($search_examples);
mysqli_free_result($author_data);
mysqli_close($con);

# Display author info if an authors name is selected.
if (!empty($author)) {
    echo "<div class=\"column column-three\">";
    echo "<h3><a href=\"" . $author['author_link'] . "\" target=\"_blank\">" . $author['name'] ."</a></h3>";
    echo "<div class=\"author-info fa fa-institution\"> " . $author['affiliation'] . "</div>";
    if (!empty($author['email'])) {
        echo "<div class=\"author-info fa fa-envelope\"> " . $author['email'] . "</div>";
    }
    echo "<img src=\"" . $author['author_img'] . "\" class=\"image author\">";
    echo $author['about'];
    echo "</div>";
}
?>