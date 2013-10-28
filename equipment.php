<!DOCTYPE html >
<html>
	<head>
	<title>WW2 Website</title>
	<meta http-equiv="description" content="page description" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<SCRIPT LANGUAGE="JavaScript">
<!-- 

// Generated at http://www.csgnetwork.com/puhtmlwincodegen.html 
			function popUp(URL) {
						day = new Date();
						id = day.getTime();
						eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=1000,height=500,left = 470,top = 140');");
			}

// -->
		</script>
	<style type="text/css">@import url(css/styles.css);</style>
	</head>

	<body>
<!--<h1>World War 2 Database</h1>-->
<?php
include "includes/navigation.php";
include ("includes/header.php");?>

<div>
This is the <B>Equipment</B> page <br><br>

<?php
// Is an argument passed?
	if (isset($_GET['equp']))
		{ $equipment = $_GET['equp']; }
	else
//
		{	echo "<h1> No Location Given</h1>";
			exit();
		}
	echo"<h1> Details of $equipment</h1>";		

		$host = "127.0.0.1";
		$user = "root";
		$pass = "nortonjuxta";
        $dbase = "ww2db";

        $selected = mysqli_connect($host, $user, $pass, $dbase);
		if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				die();
			}
// Display Equipment entry in equipment table
		$SQL = sprintf("SELECT equipment.Equipment_ID, equipment.Equipment, `equipment type`.Equipment_Type AS Type, countries.Country_Name as Country
		FROM equipment	LEFT JOIN `equipment type` ON equipment.Equipment_Type_ID = `equipment type`.Equipment_Type_ID
		LEFT JOIN `countries` ON equipment.Country_ID = countries.Country_ID
		WHERE equipment.Equipment='%s' ", mysql_real_escape_string($equipment));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No such equipment
			{echo "<p class='centre'>Equipment Not Found</p>";
			exit();}
		if ($row_cnt > 1)
// at least two Locations with same name
			{echo "<p class='centre'>$row_cnt Equipments Found</p>";}
		if ($row_cnt == 1)
// one Location found
			{
//echo "debug001";
						$row = mysqli_fetch_assoc($result);
// Look at row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{
						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								if ($j == 1)
									{ $equipmentid = $value; }
							}
					}
	echo "Equipment ID is: $equipmentid";

		}

// Units using this equipment on selected date
		echo "<h3 class ='centre'>Units with $equipment on $DateSelected</h3>";
		echo"<br>";
		$datesel = dt2ymd($DateSelected);
		$SQL = sprintf("SELECT unit.Unit, `unit type`.`Unit Type`, `force index`.Force, unitequp.`Start Date` AS 'FROM', unitequp.`End Date` as 'TO'
		FROM ((unitequp INNER JOIN unit ON unitequp.`Unit ID` = unit.Unit_ID) 
		INNER JOIN `unit type` ON unit.`Unit Type` = `unit type`.`Unittype ID`) 
		INNER JOIN `force index` ON unit.Force = `force index`.`Force ID`
		WHERE ((unitequp.`Equipment ID`)='%s' AND (unitequp.`Start Date` <= '$datesel') AND (unitequp.`End Date` >= '$datesel')) ORDER BY unit.`Unit Number`", mysql_real_escape_string($equipmentid));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No such person
			{echo "<p class='centre'>None Found</p>";}
		else
// entries found
			{
//echo "debug unitco";
			echo "<table class = 'center'>";
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
// Write row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{
						echo "<tr>";
						$j = 0;
						foreach($row as $key => $value)
							{
								echo "<td>";
								$j++;
								switch ($j)
								{
									case 1:
									case 2:
									case 3:
										echo $value;
										break;
									default:	// date fields
										if ($value)
											{ echo dt2dmy($value); }
										else echo "";
								}
								echo "</td>";
							}
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
			}
		echo"<br>";
		echo"<p class='centre'> Change Selected Date</p>";
		$datesel = $DateSelected;
		echo $datesel;
		if ($datesel=="")
			{echo "<p class='centre'> Please Enter a valid Subcampaign first</p>";}
		else
			{echo "<p class=centre><Button type = 'button' onclick=\"javascript:popUp('calendar.php')\">Change Date</button></p>";}

?>


<pre class="temp">
    <h2> Programming Notes</h2>
     
     <h3>1.Load Pre-Conditions</h3>
              1.1 The Location (passed as a parameter) must exist.
			  1.2 The Selected Date must be set (for item 2.3) This implies that the Subcampaign must be set.
     <h3>2.Notes on design</h3>
     <ol>
          2.1 Display the location entry from the location table - if there are no entries then display error message and quit. - done
          2.2 Display details of location in world. - done
          2.3 Display the list of units at the location on the selected date withe their start and End Dates. - done 
          2.4 Add means of changing "Selected Date" between "Start Date" and "End Date". 
          2.5 
          2.6 
          </ol>

    <h3>3 Exit conditions</h3>
        3.1 There are no Exit conditions - you can always exit.
</pre>
</div>

<br>

<!--<?php

include ("includes/header.html");

?>-->

</body>
</html>


