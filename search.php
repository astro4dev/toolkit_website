<?php

    include 'connect_db.php';
    
    $key=$_GET['key'];
    $array = array();

    $query=mysql_query("
        (SELECT title FROM examples WHERE title LIKE '%{$key}%') UNION
        (SELECT title FROM courses WHERE title LIKE '%{$key}%') UNION
        (SELECT title FROM assessments WHERE title LIKE '%{$key}%');");

    while($row=mysql_fetch_assoc($query))
    {
      $array[] = $row['title'];
    }
    echo json_encode($array);

?>