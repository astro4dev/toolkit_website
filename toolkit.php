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
						<h1>Astronomy & Data Science Toolkit</h1>
						<p>v.0.2.4</p>
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
					<a href="http://wsnippets.com" class="ribbon bg-purple" >Alpha version</a>
						<!-- Content -->
						<section id="content" class="main">

							<div class="search">
							<!-- <form method="post"> -->
							<input type="text" name="search" class="typeahead" autocomplete="on" id="search" spellcheck="false" placeholder="Search the toolkit" autofocus>
							 <input type="submit" class="button special" name="btnSearch" value="Search" id="btnSearch">
							 <input type="submit" class="button" name="btnAll" value="Show All" id="btnAll">
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


			var button		= document.getElementById('btnSearch');
			var showbutton	= document.getElementById('btnAll');

    		var text 		= document.getElementById('search').value;

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