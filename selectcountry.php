<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<!doctype html>
 
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>WW2 Website</title>
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
    $(function() {
    $( "#tabs-3" ).tabs();
  });
  </script>
<script>
$(function() {
    $('#govt').dataTable( {
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 25,
			 "aoColumnDefs": [
			{ "sWidth": "200px", "aTargets": [ 0,1,2,3,4 ] }
			],	
			"oLanguage": {
            "sZeroRecords": "There are no records that match your search criterion",
            "sInfoEmpty": "Showing 0 to 0 of 0 records",
            "sInfoFiltered": "(filtered from _MAX_ total records)"
        }, 
		"aaSorting": [],
		"sDom": '<"H"lr>t<"F"ip>',
		 bjQueryUI: true,
	  sPaginationType: "full_numbers"
   }).columnFilter({sPlaceHolder: "head:before",
			aoColumns: [ { "type": "text" },
				     { type: "text" },	
					 { type: "text" },
					 { type: "text" },
					 { type: "text" },
				]});
});
</script>


</head>
<body>

<!--	<h1>World War 2 Database</h1>-->
	
	<div class = 'header'>
	<?php
		include ("includes/sqllibrary.php");
		include ("includes/navigation.php");
		include ("includes/header.php");
?>
</div>
<div class = 'content'>
<?php		
		
		echo "This is the <B>Select Country</B> page <br><br>";
		
		echo "<h3 class='centre'>Select Country</h3>";
	
// Display List of countries by position in world
		echo"<br>";
		$SQL = sprintf("Select continent.Continent, subcontinent.`Sub Continent`, theatre.Theatre, countries.Country_Name AS Country, unit.Unit
		From countries Inner Join theatre On countries.Theatre = theatre.TheatreID
		Inner Join subcontinent On theatre.`Sub Continent` = subcontinent.Sub_Continent_ID
		Inner Join continent On subcontinent.Continent = continent.Continent_ID
		Inner Join unit On unit.Country = countries.Country_ID
		Inner Join `unit type` On unit.`Unit Type` = `unit type`.`Unittype ID`
		Where unit.`Unit Type` = 324
		Order By continent.Continent, subcontinent.`Sub Continent`, theatre.Theatre, countries.Country_Name");
//	324 == Head of State
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "Country sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No such country
			{echo "<p class='centre'>None Found</p>";}
		else
// entries found
			{
//echo "debug countries";
			echo "<table id = 'govt' class = 'center'>";
				echo "<thead>";
					echo "<tr>";
//						echo "debug002";
						$row = mysqli_fetch_assoc($result);
						foreach ($row as $col => $value)
							{
//								echo "debug003";
								echo "<th>";
								echo $col;
								echo "</th>";
							}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
// Write row - NO dates
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>";
						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								echo "<td>";
									switch ($j)
									{
										case 1:
										case 2:
										case 3:
										case 4:
											echo $value;
											break;
										case 5:
											echo "<a href='displayunit.php?unit=$value'>$value</a>";
											break;
									}
								echo "</td>";
							}
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
			}
		echo"<br>";

	?>
</div>
</body>
</html>