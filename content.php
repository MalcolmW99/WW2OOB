<?php
if ($_GET['content'] == 1) { 
	include "status.php";
	}

if ($_GET['content'] == 2) { 
include "WW2Events.php";
} 

if ($_GET['content'] == 3) { 
include "OOB.php";
}

if ($_GET['content'] == 4) { 
include "Campaign.php";
}

if ($_GET['content'] == 5) { 
include "findunit.php";
}

?>
