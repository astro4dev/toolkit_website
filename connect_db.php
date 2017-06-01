<?php

    $iniData        = file_get_contents('/etc/mysql/user.cnf');
    $iniData        = preg_replace('/#.*$/m', '', $iniData);
    $mysqlConfig    = parse_ini_string($iniData, true);

    $con            = mysql_connect("dbint.astro4dev.org",$mysqlConfig['client']['user'],$mysqlConfig['client']['password']);
    $db             = mysql_select_db("toolkit_db",$con);

    if (!$db) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
    }

?>