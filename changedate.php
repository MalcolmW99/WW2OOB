<!DOCTYPE html >
<head>
<title>WW2 Website</title>
<meta http-equiv="description" content="page description" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">@import url(css/styles.css);</style>
</head>

<body>
<!--<h1>World War 2 Database</h1>-->
<?php

include ("includes/header.php");
include "includes/navigation.php";

?>

<div>
This is the <B>Display Campaign</B> page <br><br>

<?php
// Is an argument passed?
		echo("Date: " . $_POST['Date'] . "<br />\n");
		$datesel = $_POST['Date'];
		echo $datesel;
		$datesel = dt2ymd($datesel);
		echo $datesel;
		if (!$datesel)
		{	echo "No date to update";
			exit();
		};
// Update selected date
		$updatesql = sprintf("UPDATE sessionvars SET sessionvars.CurrentDate = '%s' 
					WHERE (((sessionvars.User)='malcolm'));", mysql_real_escape_string($datesel));
//		echo $updatesql;

		$updateresult = mysqli_query($selected, $updatesql);

			if (!$updateresult)
			{	echo("Update Date Failed");
				exit();
			};
?>
<script type='text/javascript'>
			self.close();
</script>


<!--<?php

include ("includes/header.html");

?>-->

</body>
</html>