<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>OAD Data Science Toolkit</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>OAD Data Science Toolkit</h1>
						<p>Work in progress!</p>
					</header>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
							<section id="content" class="main">
								
								<h2>Test</h2>


						          <?php
						          		# Load user credentials
						          		$iniData = file_get_contents('/etc/mysql/user.cnf');
										$iniData = preg_replace('/#.*$/m', '', $iniData);
										$mysqlConfig = parse_ini_string($iniData, true);

										# Connect to database
										$db = mysqli_connect('dbint.astro4dev.org',$mysqlConfig['client']['user'],$mysqlConfig['client']['password'],'toolkit_db');

										if (!$db) {
										    echo "Error: Unable to connect to MySQL." . PHP_EOL;
										    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
										    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
										    exit;
										}

										if ($db->connect_errno) {
										echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
										}

						                $query = "SELECT * FROM topics_astr;";
						                $result = mysqli_query($db, $query);
						                while($row = mysqli_fetch_assoc($result)) {
						                      // Display your datas on the page
						                  echo "<br>";
						                  echo $row["topics_astr"];
						                }
						          ?>

							</section>

					</div>

				<!-- Footer -->
					<footer id="footer">
						<?php include 'footer.php';?>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>