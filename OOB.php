<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
<title>WW2 Website - OOB</title>
<meta http-equiv="description" content="page description" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/jquery-ui-1.10.2.custom.css" />
<style type="text/css">@import url(css/jquery.datatables_themeroller.css);</style>
<style type="text/css">@import url(css/styles.css);</style>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.columnFilter.js"></script>
<!--	<link rel="stylesheet" href="/resources/demos/style.css" />-->
 <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>

</head>

<body>
	<div class = 'header'>
	<?php
		include ("includes/sqllibrary.php");
		include ("includes/navigation.php");
		include ("includes/header.php");
?>
</div>
<div class = 'content'>

<div id = 'oob'>
    This is the <b>ORDER OF BATTLE</b> page <br><br>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Simple</a></li>
			<li><a href="#tabs-2">Admin</a></li>
			<li><a href="#tabs-3">Operational</a></li>
			<li><a href="#tabs-4">Pseudo</a></li>
			<li><a href="#tabs-5">Construction</a></li>
		</ul>
		
		<div id="tabs-1">
		<?php
			echo "<h3>Order of Battle for $UnitSelected on $DateSelected<?> - Links only</h3>";
			echo "<ul id='treeData1'>";
			echo "<li id = 'id1'><a href='displayunit.php?unit=$UnitSelected'>$UnitSelected</a></li>";
			echo "<ul>";
				
// Database is opened in header.php
			$datesel = dt2ymd($DateSelected);
			$level = 0;
		
			getOOBSimple($UnitSelected, $datesel, $level, $selected);
			echo "</ul>";
			echo"<br>";		
		?>
	</div>
	<div id="tabs-2">
	<?php
		echo "<h3>Order of Battle for $UnitSelected on $DateSelected<?> - Admin Links plus CO and Location</h3>";
			echo "<ul id='treeData1'>";
			echo "<li id = 'id1'><a href='displayunit.php?unit=$UnitSelected'>$UnitSelected</a></li>";
			echo "<ul>";
				
// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$level = 0;
		
		getOOBAdmin($UnitSelected, $datesel, $level, $selected);
		echo "</ul>";
		echo"<br>";		

	?>

	</div>
	<div id="tabs-3">
	<?php
		echo "<h3>Order of Battle for $UnitSelected on $DateSelected - Operational Links plus Commanding Officer, Location and Status</h3>";
			echo "<ul id='treeData1'>";
			echo "<li id = 'id1'><a href='displayunit.php?unit=$UnitSelected'>$UnitSelected</a></li>";
			echo "<ul>";
				
// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$level = 0;
		
		getOOBOp($UnitSelected, $datesel, $level, $selected);
		echo "</ul>";
		echo"<br>";		

	?>
	</div>
	<div id="tabs-4">
	<?php
		echo "<h3>Order of Battle for $UnitSelected on $DateSelected<?> - Pseudo links only</h3>";
			echo "<ul id='treeData1'>";
			echo "<li id = 'id1'><a href='displayunit.php?unit=$UnitSelected'>$UnitSelected</a></li>";
			echo "<ul>";
				
// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$level = 0;
		
		getOOBPseudo($UnitSelected, $datesel, $level, $selected);
		echo "</ul>";
		echo"<br>";	

	?>
	</div>
	<div id="tabs-5">
	<?php
		echo "<h3>Order of Battle for $UnitSelected on $DateSelected<?> - Construction Links only</h3>";
			echo "<ul id='treeData1'>";
			echo "<li id = 'id1'><a href='displayunit.php?unit=$UnitSelected'>$UnitSelected</a></li>";
			echo "<ul>";
				
// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$level = 0;
		
		getOOBConstruction($UnitSelected, $datesel, $level, $selected);
		echo "</ul>";
		echo"<br>";		

	?>

	</div>
</div>

</div>
</div>
<!--<?php include("includes/header.html");?>-->

</body>
</html>