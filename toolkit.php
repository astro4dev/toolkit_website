<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Astronomy & Data Science Toolkit</title>
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
						<h1>Astronomy & Data Science Toolkit</h1>
						<p>v.0.1.1</p>
					</header>

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
							<br />
							OR
							<br />
							


								<div class="container">

								   <div class="column column-one">
								   I'm an Astronomer interested in...

								   	<form action=""> 
									<select name="astr_topics" onchange="astr_topic(this.value)" style="width: 90%;" autocomplete="off"">
									<option selected></option>
									<?php
									while($row_topics_astr = mysqli_fetch_assoc($topics_astr)) {
									  echo "<option value='".$row_topics_astr["Id"]."'>".$row_topics_astr["topics_astr"]."</option>";
									}
									?>
									</select>
									</form>

								   </div>
								   <div class="column column-two">
								   I'm a Data Scientist interested in...

								   	<form action=""> 
									<select name="ds_topics" onchange="ds_topic(this.value)" style="width: 90%" autocomplete="off">
									<option selected></option>
									<?php
									while($row_skills = mysqli_fetch_assoc($skills)) {
									  echo "<option value='".$row_skills["Id"]."'>".$row_skills["skills"]."</option>";
									}
									?>
									</select>
									</form>

								   </div>
								   <!--- 
								   <div class="column column-three">
								   

								   <input type="checkbox" name="Courses" value="courses" id="courses"><label for="courses">Courses</label><br />
								   <input type="checkbox" name="Examples" value="examples" id="examples"><label for="examples">Examples</label><br />
								   <input type="checkbox" name="Assessments" value="assessments" id="assessments"><label for="assessments">Assessments</label><br />



								   </div>
								   -->								   


								   <div class="column column-four">

								   	<h2>How it works:</h2>

								   	Use either of the drop down menus on the left to see the toolkit content.

								   </div>
								   
								</div>


								<br>
								<div id="txtHint">Results will be listed here...</div>



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



var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // an array that will be populated with substring matches
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};




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