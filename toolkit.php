<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
	<?php include 'header.php';?>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>Astronomy & Data Science Toolkit</h1>
						<p>v.0.2.2</p>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a href="index.php#intro" class="active">Introduction</a></li>
							<li><a href="index.php#about">About the Toolkit</a></li>
							<li><a href="toolkit.php">View Toolkit</a></li>
							<li><a href="index.php#contribute">Contribute</a></li>
							<li><a href="index.php#footer">Contact</a></li>
						</ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Content -->
						<section id="content" class="main">

					        <?php
							
							# Database user configuration
			          		$iniData 		= file_get_contents('/etc/mysql/user.cnf');
							$iniData 		= preg_replace('/#.*$/m', '', $iniData);
							$mysqlConfig 	= parse_ini_string($iniData, true);
							
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
			                $query_topics_astr 		= "SELECT * FROM topics_astr;";
			                $topics_astr 			= mysqli_query($db, $query_topics_astr);
			                
			                $query_skills 			= "SELECT * FROM skills;";
			                $skills					= mysqli_query($db, $query_skills);

			                $query_subtopics_astr 	= "SELECT * FROM subtopics_astr;";
			                $subtopics_astr 		= mysqli_query($db, $query_subtopics_astr);
					        ?>

							<div class="search">
							<!-- <form method="post"> -->
							<input type="text" name="search" class="typeahead" autocomplete="on" id="search" spellcheck="false" placeholder="Search the toolkit" autofocus>
							 <input type="submit" class="button special" name="btnSearch" value="Search" id="btnSearch">
							<!-- <button onclick="myFunction()">Click me</button> -->
							<!-- </form> -->
							</div>

							<div class="search_explanation">
							This search box lets you search all toolkit titles.
							</div>



								<div id="txtHint">
								<div class="column column-four">
								<h3>Data Science</h3>
								Data science, also known as data-driven science, is an interdisciplinary field about scientific methods, processes, and systems to extract knowledge or insights from data in various forms, either structured or unstructured, similar to data mining. [ <a title="more" href="https://en.wikipedia.org/wiki/Data_science" target="_blank">more</a> from Wikipedia ].
								</div>
								</div>


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
			<script src="assets/js/typeahead.min.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

		    <script>

		    // Drop down menu showing the content of the table
			var astr_choice;
			var skill_choice;

			function astr_topic(astr_choice) {
				showContent(astr_choice, skill_choice);
			}

			function ds_topic(skill_choice) {
				showContent(astr_choice, skill_choice);					          	
			}

			function showContent(astr_choice, skill_choice) {

			if (astr_choice == "" && skill_choice == "") {
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

			    xmlhttp.open("GET","getTopic.php?astr_choice="+astr_choice+"&skill_choice="+skill_choice,true);

			    xmlhttp.send();
				}
			}

			var button		= document.getElementById('btnSearch');
			
			button.onclick	= function(){

    		var text 		= document.getElementById('search').value;

			if (text == "") {
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

			    document.getElementById("txtHint").innerHTML = text;

			    xmlhttp.open("GET","getTopic.php?keyword="+text,true);

			    xmlhttp.send();
				}

			}

			// Autocomplete box
		    $(document).ready(function(){
			    $('input.typeahead').typeahead({
			        hint: true,
			        highlight: true,
			        minLength: 1,
			        name: 'typeahead',
			        remote:'search.php?key=%QUERY',
			        limit : 10
			    });
			});
		    </script>


	</body>
</html>