<!DOCTYPE html >
<head>
<title>WW2 Website</title>
<meta http-equiv="description" content="page description" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">@import url(css/styles.css);</style>
</head>

<body>
<!--<h1>World War 2 Database</h1>-->
<div class = 'header'>
<?php
	include ("includes/header.php");
	include "includes/navigation.php";
?>
</div>
<div class = 'content'>
<br><br>This is the <B>PERSON</B> page <br><br>

<?php
// Is an argument passed?
	if (isset($_GET['person']))
		{ $person = $_GET['person']; }
	else
//
		{	echo "<h1> No Person Given</h1>";
			exit();
		}
	echo"<h1> Details of $person</h1>";		
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
// Display Selected Person entry in person table
		$SQL = sprintf("SELECT person.ID, person.`Full Name`, countries.Country_Name AS Country, person.`Date of Birth` AS DOB, person.`Date of Death` AS DOD FROM person
						LEFT JOIN `countries` ON person.`Country ID`=countries.Country_ID
						WHERE `Full Name`='%s' ", mysql_real_escape_string($person));
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
			{echo "<p class='centre'>Person Not Found</p>";
			exit();}
		if ($row_cnt > 1)
// Two people with same name
			{echo "<p class='centre'>$row_cnt people Found</p>";}
		if ($row_cnt == 1)
// one person found
			{
//echo "debug001";
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
										$personid = $value;
										echo $value;
										break;
									case 2:
									case 3:
										echo $value;
										break;
									default:	// date fields
										if ($value)
											{ echo dt2dmy($value); }
										else {echo "???";}
								}
								echo "</td>";
							}
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
			echo "<br>";


// Display Selected Person entry in unitco table - i.e. units served in
		echo "<h3 class ='centre'>Units Served in</h3>";
		echo"<br>";
		$SQL = sprintf("SELECT unit.Unit, Rank.`Rank name` AS Position, unitco.Position AS `AS`, unitco.Rank, location.Location as AT, 
IF(unitco.`Start Date`>unitlocn.`Start Date`,unitco.`Start Date`,unitlocn.`Start Date`) AS `Loc Start`, IF(unitco.`End Date` < unitlocn.`End Date`, unitco.`End Date`, unitlocn.`End Date`) AS `Loc End`
FROM person LEFT JOIN (location RIGHT JOIN ((unit RIGHT JOIN (rank RIGHT JOIN unitco ON rank.RankID = unitco.`Rank Index`) ON unit.Unit_ID = unitco.`Unit ID`)
LEFT JOIN unitlocn ON unit.`Unit_ID` = unitlocn.`Unit ID`) ON location.LocID = unitlocn.`Location ID`) ON person.ID = unitco.`Person ID`
WHERE (((unitlocn.`Start Date`)<=unitco.`End Date`) AND ((unitlocn.`End Date`)>unitco.`Start Date`) AND person.ID = '%s')
ORDER BY unitco.`Start Date`, unitlocn.`Start Date`", mysql_real_escape_string($personid));
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
									{
										echo "<a href='displayunit.php?unit=$value'>$value</a>";
										break;
									}
									case 2:
									case 3:
									case 4:
									{
										echo $value;
										break;
									}
									case 5:
										echo "<a href='location.php?locn=$value'>$value</a>";
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
// Display Selected Person events from indexlistindividual and dateref tables

		echo "<h3 class ='centre'>Events</h3>";
		echo"<br>";
		$SQL = sprintf("SELECT booklist.Book_No, memo.Comments, dateref.Date AS 'From', dateref.End_Date AS 'To'
			FROM ((indexlistindividual INNER JOIN dateref ON indexlistindividual.`Sequence Num` = dateref.Entry_No) 
			INNER JOIN memo ON dateref.Memo_ID = memo.`Entry Number`) 
			INNER JOIN booklist ON dateref.Book_ID = booklist.Book_Index
			WHERE indexlistindividual.`Name ID`='%s'
			ORDER BY dateref.Date", mysql_real_escape_string($personid));
//	echo $SQL;
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
// No events for person
			{echo "<p class='centre'>None Found</p>";}
		else
// entries found
			{
//echo "debug indexlistindividual";
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
								switch($j)
								{
									case 1:
									case 2:
										echo $value;
										break;
									default: // date fields
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
			}		
?>

<pre class="temp">
    <h2> Programming Notes</h2>
     
     <h3>1.Load Pre-Conditions</h3>
              1.1 The Person (passed as a parameter) must exist.
     <h3>2.Notes on design</h3>
     <ol>
          2.1 Display the person entry from the person table - if no entries then display error message and quit. - done		  
          2.2 Dislay the list of units in which the person served.
          2.3 Display the list of recorded events involving the person
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