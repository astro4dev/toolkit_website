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
								
								<h2>Testing</h2>


						          <?php
					          		# Load user credentials
						          	#phpinfo();
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

									# Read the contents of a table in the database
					                $query = "SELECT * FROM topics_astr;";
					                $result = mysqli_query($db, $query);
						          ?>

						          	<form action=""> 
									<select name="customers" onchange="showContent(this.value)" width="300" style="width: 300px">
									<option value='NoVal' selected disabled>Select a customer:</option>
									<?php
									while($row = mysqli_fetch_assoc($result)) {
									  echo "<option value='".$row["Id"]."'>".$row["topics_astr"]."</option>";
									}
									?>
									</select>
									</form>
									<br>
									<div id="txtHint">Customer info will be listed here...</div>

						          	<!-- Drop down menu showing the content of the table -->
						          	<script>
									function showContent(str) {
									    if (str == "") {
									        document.getElementById("txtHint").innerHTML = "";
									        return;
									    } else {
									        if (window.XMLHttpRequest) {
									            // code for IE7+, Firefox, Chrome, Opera, Safari
									            xmlhttp = new XMLHttpRequest();
									        } else {
									            // code for IE6, IE5
									            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
									        }
									        xmlhttp.onreadystatechange = function() {
									            if (this.readyState == 4 && this.status == 200) {
									                document.getElementById("txtHint").innerHTML = this.responseText;
									            }
									        };
									        xmlhttp.open("GET","getTopic.php?q="+str,true);
									        xmlhttp.send();
									    }
									}
									</script>

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