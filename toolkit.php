<!DOCTYPE HTML>
<html>
	<head>
	<?php include 'header.php';?>
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">

						<!-- ENGLISH -->
						<h1 lang="en">Astronomy & Data Science Toolkit</h1>
						<!-- SPANISH -->
						<h1 lang="es">Toolkit de Astronomía y Ciencia de Datos</h1>
						<!-- FRENCH -->
						<h1 lang="fr">Astronomy & Data Science Toolkit</h1>

						<p>v.0.2.6</p>
					</header>

				<!-- Nav -->
					<nav id="nav">
						<ul>

							<!-- ENGLISH -->
							<li lang="en"><a href="index.php#intro" class="active">Introduction</a></li>
							<li lang="en"><a href="index.php#about">About the Toolkit</a></li>
							<li lang="en"><a href="toolkit.php">View Toolkit</a></li>
							<li lang="en"><a href="index.php#contribute">Contribute</a></li>
							<li lang="en"><a href="index.php#footer">Contact</a></li>

							<!-- SPANISH -->
							<li lang="es"><a href="index.php#intro" class="active">Introducción</a></li>
							<li lang="es"><a href="index.php#about">Sobre el Toolkit</a></li>
							<li lang="es"><a href="toolkit.php">Ver Toolkit</a></li>
							<li lang="es"><a href="index.php#contribute">Contribuir</a></li>
							<li lang="es"><a href="index.php#footer">Contáctenos</a></li>

							<!-- FRENCH -->
							<li lang="fr"><a href="index.php#intro" class="active">Introduction</a></li>
							<li lang="fr"><a href="index.php#about">À propos du toolkit</a></li>
							<li lang="fr"><a href="toolkit.php">Voir le Toolkit</a></li>
							<li lang="fr"><a href="index.php#contribute">Contribuer</a></li>
							<li lang="fr"><a href="index.php#footer">Contactez nous</a></li>

							<li>
							<select id="lang-switch" class="fa-select">
							  <option value="en" selected>&#xf1ab; English</option>
							  <option value="es" >&#xf1ab; Espanol</option>
							  <option value="fr" >&#xf1ab; Français</option>
							</select>
							</li>

						</ul>
					</nav>

				<!-- Main -->
					<div id="main">
					<a href="http://wsnippets.com" class="ribbon bg-purple" >Alpha version</a>
						<!-- Content -->
						<section id="content" class="main">

							<div class="search">
							<!-- <form method="post"> -->
							<input type="text" name="search" class="typeahead" autocomplete="on" id="search" spellcheck="false" placeholder="Search the toolkit e.g: Exoplanet" autofocus>
							 <input type="submit" class="button special" name="btnSearch" value="Search" id="btnSearch">
							 <input type="submit" class="button" name="btnAll" value="Show All" id="btnAll">
							<!-- <button onclick="myFunction()">Click me</button> -->
							<!-- </form> -->
							</div>


							<!-- ENGLISH -->
							<div class="search_explanation" lang="en">
							This search box lets you search all toolkit titles.
							</div>

							<!-- SPANISH -->
							<div class="search_explanation" lang="es">
							This search box lets you search all toolkit titles.
							</div>

							<!-- FRENCH -->
							<div class="search_explanation" lang="fr">
							This search box lets you search all toolkit titles.
							</div>


							<div id="txtHint">

							<div class="column column-one">

							<!-- ENGLISH -->
							<h3 lang="en">Data Science</h3>
							<p lang="en">Data science, also known as data-driven science, is an interdisciplinary field about scientific methods, processes, and systems to extract knowledge or insights from data in various forms, either structured or unstructured, similar to data mining. [ <a title="more" href="https://en.wikipedia.org/wiki/Data_science" target="_blank">more</a> from Wikipedia ].

							<!--
							<ul>
							<li><a href="#" onclick="catQuery('skill_topic', 'Wrangling');"><i>Data Wrangling</i></a></li>
							<li><a href="#" onclick="catQuery('skill_topic', 'Python');"><i>Python</i></a></li>
							<li><a href="#" onclick="catQuery('skill_topic', 'Machine Learning');"><i>Machine Learning</i></a></li>
							</ul>
							-->


							</p>

							<!-- SPANISH -->
							<h3 lang="es">Data Science</h3>
							<p lang="es">Data science, also known as data-driven science, is an interdisciplinary field about scientific methods, processes, and systems to extract knowledge or insights from data in various forms, either structured or unstructured, similar to data mining. [ <a title="more" href="https://en.wikipedia.org/wiki/Data_science" target="_blank">more</a> from Wikipedia ].</p>

							<!-- FRENCH -->
							<h3 lang="fr">Data Science</h3>
							<p lang="fr">Data science, also known as data-driven science, is an interdisciplinary field about scientific methods, processes, and systems to extract knowledge or insights from data in various forms, either structured or unstructured, similar to data mining. [ <a title="more" href="https://en.wikipedia.org/wiki/Data_science" target="_blank">more</a> from Wikipedia ].</p>							


							</div>

							<div class="column column-two">

							<!-- ENGLISH -->
							<h3 lang="en">Astronomy</h3>
							<p lang="en">Please select from the topics below.
							<ul>
							<li><a href="#" onclick="catQuery('astr_topic', 'Galaxies');"><i>Galaxies</i></a></li>
							<li><a href="#" onclick="catQuery('astr_topic', 'Solar');"><i>Solar & Stellar</i></a></li>
							<li><a href="#" onclick="catQuery('astr_topic', 'Planetary');"><i>Planetary science</i></a></li>
							</ul>
							</p>

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

		    <script type="text/javascript">


			var button		= document.getElementById('btnSearch');
			var showbutton	= document.getElementById('btnAll');

    		var text 		= document.getElementById('search').value;

    		// Show all toolkit results
			showbutton.onclick	= function(){
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

			    xmlhttp.open("GET","getTopic.php?keyword="+'',true);

			    xmlhttp.send();
			}

			// Show results which match the search keyword
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

			    xmlhttp.open("GET","getTopic.php?keyword="+text,true);
			    xmlhttp.send();
				}
			}

			function catQuery(category, query) {
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

			    xmlhttp.open("GET","getTopic.php?"+category+"="+query,true);

			    xmlhttp.send();
			}


			// Autocomplete search box
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