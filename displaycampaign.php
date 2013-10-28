<!DOCTYPE html >
<head>
<title>WW2 Website</title>
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
<script>
$(function() {
    $('#govt').dataTable( {
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 40,			
			 "aoColumnDefs": [
			{ "sWidth": "100px", "aTargets": [ 0,1,2,3 ] }
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
					null,
					{ type: "text" },
					null,
					null,
					null,
					null,
				]});
});
</script>

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
This is the <B>Display Campaign</B> page <br><br>

<?php
// Is an argument passed?
	if (isset($_GET['cmpgn']))
		{ $subcampaign = $_GET['cmpgn']; }
	else
//
		{	echo "<h1> No Sub Campaign Given</h1>";
			exit();
		}
	echo"<h1> Details of $subcampaign SubCampaign</h1>";		
	
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
// Display Selected Sub Campaign entry in Keyword Sub Campaign List table
		$SQL = sprintf("SELECT `keyword sub campaign list`.SubCampaignID as ID, `keyword_campaign_list`.`Campaign Keyword` AS Campaign, `keyword sub campaign list`.`Sort Order`, 
						`keyword sub campaign list`.Description, `keyword sub campaign list`.`Start Date`, `keyword sub campaign list`.`End Date` FROM `keyword sub campaign list`
						LEFT JOIN `keyword_campaign_list` ON `keyword sub campaign list`.CampaignID = `keyword_campaign_list`.Campaign_ID
						WHERE `keyword sub campaign list`.Sub_Campaign='%s' ", mysql_real_escape_string($subcampaign));
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
// No such Sub Campaign
			{echo "<p class='centre'>Sub Campaign Not Found</p>";
			exit();}
		if ($row_cnt > 1)
// Two SC's with same name
			{echo "<p class='centre'>$row_cnt sub campaigns found</p>";}
		if ($row_cnt == 1)
// one sub campaign found
		{
//echo "debug001";
		$result="";
		$result = mysqli_query($selected, $SQL);
		if (!$result)
		{
			echo "sql failed<br>";
			printf("Errormessage: %s\n", mysqli_error($selected));
			mysqli_close($selected);
			die();
		}
		$row_cnt = mysqli_num_rows($result);
		echo "Row Count: $row_cnt";
		if ($row_cnt <> 0)	
		{
			echo "<table class = 'center'>";
				echo "<thead>";
					echo "<tr>";
//					echo "debug002";
					$row = mysqli_fetch_assoc($result);
					foreach ($row as $col => $value)
					{
//						echo "debug004";
						echo "<th>";
						echo $col;
						echo "</th>";
					}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
// Write rows
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
								$subcampaignid = $value;
								{ echo $value;}
								 break;
							case 2:  // NOT CORRECT - can not YET display a campaign - only a subcampaign
//								echo "<a href='displaycampaign.php?camp=$value'>$value</a>";
//								break;
							case 3:
							case 4:
								{ echo $value;}
								break;
		// date fields
							default:
								{if ($value) 
									{ echo dt2dmy($value);}
								else echo "";}
						}
						echo "</td>";
					}
					echo "</tr>";
				}
				echo "</tbody>";
			echo "</table>";
		}
		echo "<br>";
		echo "ID = $subcampaignid";
		}
//		echo $subcampaign;
		echo "<p class=centre><Button type = 'button' onclick=\"window.location.href='setcampaign.php?setcmpgn=$subcampaign'\">$subcampaign</button></p>";
		echo "<p class=centre><Button type = 'button' onclick=\"javascript:popUp('calendar.php')\">Change Date</button></p>";
		echo"<FORM class='centre'> <INPUT TYPE='button' onClick='history.go(0)' VALUE='Refresh'></FORM>";
		echo "<h3 class ='centre'> Units in Subcampaign on $DateSelected</h3>";
		echo"<br>";
// Display units for selected sub Campaign from unitcampaign table on selected date($DateSelected)
		$datesel = dt2ymd($DateSelected);
		$SQL = sprintf("Select unit.Unit, location.Location As AT, combatants.Combatant_Type As Allegiance, unitcampaign.`Senior Unit Flag`, unitcampaign.level,
		unitcampaign.`Start Date` As `UC Start`, unitcampaign.`End Date` As `UC End`,
		unitlocn.`Start Date` As `Locn Start`, unitlocn.`End Date` As `Locn End`,
		`country allegiance`.Start_Date As `alg Start`, `country allegiance`.End_Date As `alg end`
		From unit Inner Join unitlocn On unitlocn.`Unit ID` = unit.Unit_ID
		Inner Join location On unitlocn.`Location ID` = location.LocID
		Inner Join unitcampaign On unitcampaign.`Unit ID` = unit.Unit_ID
		Inner Join countries On unit.Country = countries.Country_ID
		Inner Join `country allegiance` On `country allegiance`.Country_ID = countries.Country_ID
		Inner Join combatants On `country allegiance`.Allegiance = combatants.Combatant_ID
		WHERE unitcampaign.`Sub Campaign ID`='%s' AND ('%s' BETWEEN unitcampaign.`Start Date` AND unitcampaign.`End Date`)
		AND ('%s' BETWEEN unitlocn.`Start Date` AND unitlocn.`End Date`) AND ('%s' BETWEEN `country allegiance`.Start_Date AND `country allegiance`.`End_Date`)
		ORDER BY unitcampaign.level, unit.Unit", mysql_real_escape_string($subcampaignid), mysql_real_escape_string($datesel), mysql_real_escape_string($datesel), mysql_real_escape_string($datesel));
//		echo $SQL;
		$result="";
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
		echo "Row Count: $row_cnt";
		if ($row_cnt <> 0)	
		{
		echo "<div class = 'threeqtr'>";
			echo "<table id = 'govt' class = 'center'>";
				echo "<thead>";
					echo "<tr>";
//					echo "debug002";
					$row = mysqli_fetch_assoc($result);
					foreach ($row as $col => $value)
					{
//						echo "debug004";
						echo "<th>";
						echo $col;
						echo "</th>";
					}
					echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
			// Write rows
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
									echo "<a href='displayunit.php?unit=$value'>$value</a>";
									break;
								case 2:
									echo "<a href='location.php?locn=$value'>$value</a>";
									break;
								case 3:
								case 4:
								case 5:
									echo $value;
									break;
						// date fields
								default:
									{if ($value) 
										{ echo dt2dmy($value);}
									else echo "";}
							}
							echo "</td>";
						}
					echo "</tr>";
				}
				echo "</tbody>";
			echo "</table>";
		echo "</div>";
		echo "<br>";
		}
// No Campaigns found
		else {echo "<p class='centre'>None Found</p>";}
		echo"<br>";
// Display events for selected date from dateref table

		echo "<h3 class ='centre'>$subcampaign Events on $DateSelected</h3>";
		echo"<br>";
		$SQL = sprintf("Select booklist.Book_No, memo.Comments, memo.`Level No`, `keyword sub campaign list`.Sub_Campaign, dateref.Date, dateref.End_Date
		From booklist Inner Join dateref On dateref.Book_ID = booklist.Book_Index
		Inner Join memo On dateref.Memo_ID = memo.`Entry Number`
		Inner Join `keyword sub campaign list` On dateref.Sub_Campaign = `keyword sub campaign list`.SubCampaignID
		WHERE dateref.Sub_Campaign='%s' and ('%s' BETWEEN dateref.Date AND dateref.End_Date) ORDER BY memo.`Level No`, dateref.Date", 
		mysql_real_escape_string($subcampaignid), mysql_real_escape_string($datesel));
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
		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No events for sub campaign
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
										echo "<a href='book.php?book=$value'>$value</a>";
										break;
									case 2:
									case 3:
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
	
?>

<pre class="temp">
    <h2> Programming Notes</h2>
     
     <h3>1.Load Pre-Conditions</h3>
              1.1 The Sub Campaign (passed as a parameter) must exist.
     <h3>2.Notes on design</h3>
     <ol>
          2.2 
          2.3 
          2.4 
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