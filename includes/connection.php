<?php
	$host = "localhost";
	$user = "root";
	$pass = "nortonjuxta";
	$dbase = "ww2db"

	$mysqli = mysqli_connect($host, $user, $pass, $dbase) or die (mysqli_error());

//	mysqli_select_db($dbase);

?>