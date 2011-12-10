<!DOCTYPE html>
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License
Name       : Domesticated
Description: A two-column, fixed-width design for 1024x768 screen resolutions.
Version    : 1.0
Released   : 20100701
-->
<html>
<head>
<meta charset="UTF-8">
<title>OpenComm</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<script type="text/javascript" src="jquery/jquery-1.4.2.min.js">
        </script>
<script type="text/javascript" src="jquery/jquery.slidertron-0.1.js">
        </script>
<script type="text/javascript">
            function setWrapperHeight(){
                colheight = document.getElementsByClassName("col1")[0].offsetHeight;
                document.getElementById("three-columns").style.height = colheight + "px";
                document.getElementsByClassName("col2")[0].style.height = (colheight - 50) + "px";
            }
        </script>
<link href="css/style.css" rel="stylesheet" type="text/css"
	media="screen" />
<link href="css/tallwrapper.css" rel="stylesheet" type="text/css"
	media="screen" />
<style type="text/css">
</style>
</head>
<body onload="javaript:setWrapperHeight();">
<!-- end #header-wrapper -->
<div id="header">
<div id="logo">
<h1><a href="home.html">OpenComm</a></h1>
<p><img src="" alt="" /></p>
</div>
<div id="menu">
<ul>
	<li><a href="home.html" class="first">Homepage</a></li>
	<li><a href="features.html">Features</a></li>
	<li><a href="demo.html">Demos</a></li>
	<li><a href="awards.html">Awards</a></li>
	<li><a href="aboutus.html">About Us</a></li>
	<li class="current_page_item"><a href="join.html">Join Us</a></li>
</ul>
</div>
<!-- end #menu --></div>
<!-- end #header -->
<hr />
<div id="wrapper"><!-- end #logo -->
<div id="three-columns">
<div class="col1">
<div id="foobar">
<div class="viewer">
<p>Thank you for your interest in OpenComm! Please fill out the
application form below</p>
<form action="application.php" method="post"
	enctype="multipart/form-data">
<ul>
	<li>
	<p>Your name:</p>
	<input type="text" name="name" /></li>
	<li>
	<p>Graduate/Undergraduate:</p>
	<!--select graduate (MEng, PhD, Masters), undergraduate --> <input
		type="text" name="grad" /></li>
	<li>
	<p>Graduation year:</p>
	<input type="text" name="year" /></li>
	<li>
	<p>Major:</p>
	<input type="text" name="major" /></li>
	<li>
	<p>Email:</p>
	<input type="text" name="email" /></li>
	<li>
	<p>Resume:</p>
	<p>*Please attach your resume in .doc or .pdf format.</p>
	<input type="file" name="resume" /></li>
	<li><input id="submit" type="submit" name="submit"
		value="Submit application" /></li>
</ul>
</form>
</div>
</div>
</div>
<div class="col2"><img src="" alt="" /></div>
</div>
</div>
<!-- end #page -->
</div>
<div id="footer">
<p>Copyright (c) 2008 Sitename.com. All rights reserved. Design by <a
	href="http://www.freecsstemplates.org/">CSS Templates</a>.</p>
</div>
<!-- end #footer -->
</body>
</html>


<?php
if (isset($_POST["submit"])) {
	print("submitted");
	if (isset($_POST["name"]) && isset($_POST["grad"]) && isset($_POST["year"]) && isset($_POST["major"])) {
		print("valid entries");
		$name = mysql_real_escape_string(htmlentities(trim(strip_tags($_POST["name"]))));
		$grad = mysql_real_escape_string(htmlentities(trim(strip_tags($_POST["grad"]))));
		$year = mysql_real_escape_string(htmlentities(trim(strip_tags($_POST["year"]))));
		$major = mysql_real_escape_string(htmlentities(trim(strip_tags($_POST["major"]))));

		if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
			print("valid file");
			$message = "Applicant name: "+$name + \n + "Graduate/Undergraduate: " + $grad + \n + "Graduation Year: " + $year + \m + "Major: " + $major;
			//move_uploaded_file($_FILES['newphoto']['tmp_name'], "./Images/".$_FILES['newphoto']['name']);
			//$_SESSION['photos'][] = $_FILES['newphoto']['name'];
			require('classes/AttachmentEmail.php');
			$email = new AttachmentEmail("as2288@cornell.edu", "OpenComm application", $message,$_FILES['newphoto']['tmp_name']);
			$email -> mail();
		}
	}
}
?>