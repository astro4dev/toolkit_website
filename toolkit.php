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
		<link rel="stylesheet" href="assets/css/custom.css" />
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
								
								<!-- <h2>Testing</h2> -->

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
					                $query_topics_astr 	= "SELECT * FROM topics_astr;";
					                $topics_astr 		= mysqli_query($db, $query_topics_astr);
					                
					                $query_skills 	= "SELECT * FROM skills;";
					                $skills			= mysqli_query($db, $query_skills);

					                $query_subtopics_astr 	= "SELECT * FROM subtopics_astr;";
					                $subtopics_astr 		= mysqli_query($db, $query_subtopics_astr);
						          ?>

									<div class="container">
									   <div class="column column-one">
									   	
									   	<!-- <div class="topic-header">Astronomy Topics:</div> -->
									   	<form action=""> 
										<select name="astr_topics" onchange="astr_topic(this.value)" style="width: 90%;" autocomplete="off"">
										<option selected>Select a Astronomy Topic:</option>
										<?php
										while($row_topics_astr = mysqli_fetch_assoc($topics_astr)) {
										  echo "<option value='".$row_topics_astr["Id"]."'>".$row_topics_astr["topics_astr"]."</option>";
										}
										?>
										</select>
										</form>
									   
									   </div>
									   <div class="column column-two">
									   
									   	<!-- <div class="topic-header">Data Science Topics:</div> -->
									   	<form action=""> 
										<select name="ds_topics" onchange="ds_topic(this.value)" style="width: 90%" autocomplete="off">
										<option selected>Select a Data Sciene Topic:</option>
										<?php
										while($row_skills = mysqli_fetch_assoc($skills)) {
										  echo "<option value='".$row_skills["Id"]."'>".$row_skills["skills"]."</option>";
										}
										?>
										</select>
										</form>

									   </div>
									   <div class="column column-three">

									   	<h2>How it works:</h2>

									   	<p>Select from the drop down menus on the left.</p>

									   </div>
									</div>

									<br>
									<div id="txtHint">Results will be listed here...</div>

						          	<!-- Drop down menu showing the content of the table -->
						          	<script>

						          	var astr_choice;
						          	var ds_choice;

						          	function astr_topic(x) {
						          		astr_choice = x;
										showContent(astr_choice, ds_choice);
										//if (typeof ds_choice != 'undefined') {
										// showContent(astr_choice, ds_choice);
										//}
						          	}

						          	function ds_topic(x) {
						          		ds_choice 	= x;
						          		showContent(astr_choice, ds_choice);
										//if (typeof astr_choice != 'undefined') {
										// showContent(astr_choice, ds_choice);
										//}						          	
						          	}

									function showContent(astr_choice, ds_choice) {

									    if (astr_choice == "" && ds_choice == "") {
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

									        //xmlhttp.open("GET","getTopic.php?q="+value1+"&t="+value2,true);
									        xmlhttp.open("GET","getTopic.php?astr_choice="+astr_choice+"&ds_choice="+ds_choice,true);

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