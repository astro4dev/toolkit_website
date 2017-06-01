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
							
							<!-- <h2>Testing</h2> -->

					        <?php
							# Connect to database
							include 'connect_db.php';

							# Read the contents of a table in the database
			                $query_topics_astr 		= "SELECT * FROM topics_astr;";
			                $topics_astr 			= mysqli_query($db, $query_topics_astr);
			                
			                $query_skills 			= "SELECT * FROM skills;";
			                $skills					= mysqli_query($db, $query_skills);

			                $query_subtopics_astr 	= "SELECT * FROM subtopics_astr;";
			                $subtopics_astr 		= mysqli_query($db, $query_subtopics_astr);
					        ?>

							<div class="search">
							<input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type your Query">
							<!-- <form>
							 <input id="search" type="search" placeholder="Search the toolkit" name="typeahead" autofocus>
							<input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" spellcheck="false" placeholder="Type your Query">
							<<button type="submit" class="button special">Search</button>
							</form> -->
							</div>

								<!--
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
								   <div class="column column-three">
								   

								   <input type="checkbox" name="Courses" value="courses" id="courses"><label for="courses">Courses</label><br />
								   <input type="checkbox" name="Examples" value="examples" id="examples"><label for="examples">Examples</label><br />
								   <input type="checkbox" name="Assessments" value="assessments" id="assessments"><label for="assessments">Assessments</label><br />



								   </div>									   

								   <!--
								   <div class="column column-four">

								   	<h2>How it works:</h2>

								   	Use either of the drop down menus on the left to see the toolkit content.

								   </div>
								   
								</div>
								-->

								<br>
								<!-- <div id="txtHint">Results will be listed here...</div> -->
								<div id="txtHint"></div>

					          	


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

			function astr_topic(x) {
				astr_choice = x;
			showContent(astr_choice, skill_choice);
			}

			function ds_topic(x) {
				skill_choice 	= x;
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

			// Autocomplete box
		    $(document).ready(function(){
			    $('input.typeahead').typeahead({
			        name: 'typeahead',
			        remote:'search.php?key=%QUERY',
			        limit : 10
			    });
			});
		    </script>


	</body>
</html>