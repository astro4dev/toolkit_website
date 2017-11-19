<!--
toolkit.php - The job of this file is to pass information from the user to the file getTopic.php.
This is done through the search box (including buttons) or from the two boxes on the page which
each contain direct links. The functions for passing the variables are at the end of this file.

Finally, the autocomplete feature of the search box is made possible with the typehead.js library
found on: https://twitter.github.io/typeahead.js/
-->

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

			<p>v.0.3.0</p>
		</header>

		<!-- Nav -->
		<?php include 'nav.php';?>

		<!-- Main -->
		<div id="main">

			<!-- Content -->
			<section id="content" class="main">

				<div class="search">
					<!-- <form method="post"> -->
					<input type="text" name="search" class="typeahead" autocomplete="on" id="search" spellcheck="false" placeholder="Search..." autofocus>
					<input type="submit" class="button special" name="btnSearch" value="Search" id="btnSearch">
					<input type="submit" class="button" name="btnAll" value="Show All" id="btnAll">
					<!-- </form> -->
				</div>


				<!-- ENGLISH -->
				<div class="search_explanation" lang="en">
				</div>

				<!-- SPANISH -->
				<div class="search_explanation" lang="es">
				</div>

				<!-- FRENCH -->
				<div class="search_explanation" lang="fr">
				</div>


				<div id="txtHint">

					<div class="column column-one">

						<!-- ENGLISH -->
						<h3 lang="en">Data Science</h3>
						<p lang="en">I am a data scientist interested in using astronomy examples for my teaching:</p>
						<ul>
							<li><a href="#" onclick="catQuery('skills', 'Data Wrangling');"><i>Data Wrangling</i></a></li>
							<li><a href="#" onclick="catQuery('skills', 'Python');"><i>Python</i></a></li>
							<li><a href="#" onclick="catQuery('skills', 'Machine Learning');"><i>Machine Learning</i></a></li>
						</ul>

						<!-- SPANISH -->
						<h3 lang="es">Ciencia de datos</h3>
						<p lang="es">Me dedico a la ciencia de datos y estoy interesado en utilizar ejemplos de astronomía para mi enseñanza:</p>
						<ul lang="es">
							<li><a href="#" onclick="catQuery('skills', 'Data Wrangling');"><i>Data Wrangling</i></a></li>
							<li><a href="#" onclick="catQuery('skills', 'Python');"><i>Python</i></a></li>
							<li><a href="#" onclick="catQuery('skills', 'Machine Learning');"><i>Machine Learning</i></a></li>
						</ul>

						<!-- FRENCH -->
						<h3 lang="fr">Data Science</h3>
						<p lang="fr">I am a data scientist interested in using astronomy examples for my teaching:</p>
						<ul lang="fr">
							<li><a href="#" onclick="catQuery('skills', 'Data Wrangling');"><i>Data Wrangling</i></a></li>
							<li><a href="#" onclick="catQuery('skills', 'Python');"><i>Python</i></a></li>
							<li><a href="#" onclick="catQuery('skills', 'Machine Learning');"><i>Machine Learning</i></a></li>
						</ul>					


					</div>

					<div class="column column-two">

						<!-- ENGLISH -->
						<h3 lang="en">Astronomy</h3>
						<p lang="en">I am an astronomer interested in seeing data science techniques used within the field of:</p>
						<ul>
							<li><a href="#" onclick="catQuery('astr_topic', 'Galaxies');"><i>Galaxies</i></a></li>
							<li><a href="#" onclick="catQuery('astr_topic', 'Solar');"><i>Solar & Stellar</i></a></li>
							<li><a href="#" onclick="catQuery('astr_topic', 'Planetary');"><i>Planetary science</i></a></li>
						</ul>

						<!-- SPANISH -->
						<h3 lang="es">Astronomía</h3>
						<p lang="es">Me dedico a la astronomía y estoy interesado en utilizar técnicas de ciencia de datos en el área de:</p>
						<ul lang="es">
							<li><a href="#" onclick="catQuery('astr_topic', 'Galaxies');"><i>Galaxias</i></a></li>
							<li><a href="#" onclick="catQuery('astr_topic', 'Solar');"><i>Sol y estrellas</i></a></li>
							<li><a href="#" onclick="catQuery('astr_topic', 'Planetary');"><i>Ciencia planetaria</i></a></li>
						</ul>						

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

    		/* This function passes an empty variable called keyword.
    		E.g keyword = '', when the 'Show all button is pressed'.
			The empty keyword triggers the conditional statement:
			if (!empty($keyword)) which can be found in getTopic.php
    		*/
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

			/* This function is similar to the one described above, however,
			this time the keyword parameter carries a variable in the form
			of a string which is used to search the database.
			*/
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

			/* This function passes to variables to getTopic.php:
			category: The categoary such as skills, astro_topic (basically
			which database to look for results)
			and
			query: The Data Science or Astronomy topics. Look for where the
			catQuery fucntion is used above to see examples.
			*/
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


			/* This function does the search box autocompletion. The code is all
			in typeahead.min.js which is loaded a above.
			*/
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