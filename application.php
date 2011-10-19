<div id="content">
	<p>Thank you for your interest in OpenComm! Please fill out the application form below</p>
	<form action="application.php" method="post"  enctype="multipart/form-data">
		<ul>
			<li>
				<p>Your name:</p>
				<input type="text" name="name" />
			</li>
			<li>
				<p>Graduate/Undergraduate:</p>
				<!--select graduate (MEng, PhD, Masters), undergraduate -->
				<input type="text" name="grad" />
			</li>
			<li>
				<p>Graduation year:</p>
				<input type="text" name="year" />
			</li>
			<li>
				<p>Major:</p>
				<input type="text" name="major" />
			</li>
			<li>
				<p>Resume:</p>
				<p>*Please attach your resume in .doc or .pdf format.</p>
				<input type="file" name="resume"/>
			</li>
			<li><input id="submit" type="submit" name="submit" value="Submit application"  /></li>
		</ul>
	</form>
</div>

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