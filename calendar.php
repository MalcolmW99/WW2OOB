<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
	<head>
		<title>WW2 Website - Calendar</title>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css/jquery.datepick.css"> 
		<script type="text/javascript" src="js/jquery.datepick.js"></script>
		<meta http-equiv="description" content="page description" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<style type="text/css">@import "css/styles.css";</style>
		<script type="text/javascript" src="js/mydatepick.js"></script>
<!--		<script type="text/javascript" src="js/jquery-ui.js"></script>-->

	</head>

	<body>


		<form action="changedate.php"; method="post";>
<?php
			include "includes/header.php";
			echo "Date Start: <span id='ssss'>$StartDate</span>\n";
			echo "Date End: <span id='ssss'>$EndDate</span>\n";
?>
			<p><input type="text" id="popupDatepicker" name="Date"></p>
			<p><input type="submit" name="submit" value="Submit" disabled="true" /></p>

		</form>
	</body>
</html>