<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>WW2 Website - Campaign</title>
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
			function popUpwindow(URL, campaign) {
						day = new Date();
						id = day.getTime();
						URL = URL + "?setcmpgn=" + campaign;
						eval("window.open(URL, '" + "?=" + "', 'toolbar=0,scrollbars=0,location=1,statusbar=0,menubar=0,resizable=0,width=1000,height=500,left = 470,top = 140');");
			}

// -->

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
    $('#cmpgn').dataTable( {
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 50,			
			 "aoColumnDefs": [
			{ "sWidth": "250px", "aTargets": [ 1 ] }
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
			aoColumns: [ { type: "text" },	
					 { type: "text" },
					 { type: "text" },
					 { type: "text" },
					 { type: "text" },
					 { type: "number" },
					null,
					null,
				]});
});
</script>

</head>

<body>
<!--	<h1>World War 2 Database</h1> -->
<div class = 'header'>
	<?php 	
		include("includes/header.php");
		include("includes/navigation.php");
	?>
</div>
<div class = 'content'>
This is the <B>CAMPAIGN</B> page <br><br>

		<FORM class='centre'>
			<INPUT TYPE="button" onClick="history.go(0)" VALUE="Refresh">
		</FORM>
		
		

<?php
		echo "<p class = 'centre'><a href = 'displaycampaign.php?cmpgn=$SubCampaignSelected'>$SubCampaignSelected</a> selected</p>";
		$datesel = $DateSelected;
//		echo $datesel;
		if ($datesel=="")
			{echo "<p class='centre'> Please Enter a valid Subcampaign first</p>";}
		else
			{echo "<p class=centre><Button type = 'button' onclick=\"javascript:popUp('calendar.php')\">Change Date</button></p>";}

    $selected = connectdb();

		echo "<h2 class='centre'> Select from Sub Campaigns on $DateSelected</h2><br>";
//		$temp = include "includes/library.php";
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
// Display Selected Unit entry in Unit table
		$datesel = dt2ymd($DateSelected);
			$SQL = sprintf("SELECT keywordfrontlist.Front, keyword_campaign_list.`Campaign Keyword` As Campaign, `keyword sub campaign list`.Sub_Campaign As `Sub Campaign`,
			`keyword sub campaign list`.Forces, `keyword sub campaign list`.Description, `keyword sub campaign list`.`Sort Order`,
			`keyword sub campaign list`.`Start Date`, `keyword sub campaign list`.`End Date`
			From keywordfrontlist Inner Join keyword_campaign_list On keyword_campaign_list.`Front ID` = keywordfrontlist.FrontID
			Inner Join `keyword sub campaign list` On `keyword sub campaign list`.CampaignID = keyword_campaign_list.Campaign_ID
			WHERE '%s' BETWEEN `keyword sub campaign list`.`Start Date` AND `keyword sub campaign list`.`End Date` 
			ORDER BY `keyword sub campaign list`.`Sort Order`;", mysql_real_escape_string($datesel));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		$row_cnt = mysqli_num_rows($result);
		echo "Row Count: $row_cnt";
		if (!$result)
			{
				echo "sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
		if ($row_cnt <> 0)	
			{
//echo "debug001";
			echo "<table id = 'cmpgn' class = 'center'>";
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
								case 3:
//									echo "<a href='setcampaign.php?cmpgn=$value'>$value</a>";
									echo "<button  type = 'button' onclick=\"javascript:popUpwindow('setcampaign.php', '$value')\">$value</button>";
									break;
								case 1:
								case 2:
								case 4:
								case 5:
								case 6:
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
			}
// Unit not in database
		else {
			echo "<p class='centre'>Unit Not Found</p>";
			exit();
			}

		echo"<br>";
	
?>

</pre>
<!--
<form action="">
<select name="cars">
<option value="volvo">Volvo</option>
<option value="saab">Saab</option>
<option value="fiat">Fiat</option>
<option value="audi">Audi</option>
</select>
</form>
-->
    <pre class="temp">
        <strong> 1 Programming Notes</strong>
        <strong> 1.1 Load Pre-Conditions</strong>
            1.1.1 None - the page can always load.
            
         <strong> 1.2 Notes on design</strong>
            1.2.1 Page displays current Front; Campaign; Subcampaign, Unit and Country
            1.2.2 Page displays 4 buttons to select Front; Campaign; Subcampaign and Unit - not one for Country as this comes from Unit
            1.2.3 Press FRONT button
                1.2.3.1 Display pop-up Form with a Combo box with all Fronts
                1.2.3.2 Select any Front in Combo box
                1.2.3.3 Press SUBMIT - popup disappears
                1.2.3.4 Page rewritten with new FRONT displayed but Campaign; Subcampaign and Unit are blank and Subcampaign and Unit buttons are disabled
            1.2.4 Press CAMPAIGN button - this can be after FRONT or on first load
                1.2.4.1 Display pop-up Form with a table with all Campaigns on selected FRONT
                1.2.4.2 Select any Campaign in table
                1.2.4.3 Press SUBMIT - popup disappears
                1.2.4.4 Page rewritten with existing FRONT and new CAMPAIGN displayed but Subcampaign and Unit are blank and Unit button is disabled
            1.2.5 Press SUBCAMPAIGN button this can be after Campaign or on first load
                1.2.5.1 Display pop-up Form with a table with all SubCampaigns on selected Campaign
                1.2.5.2 Select any SubCampaign in table
                1.2.5.3 Press SUBMIT - popup disappears
                1.2.5.4 Page rewritten with existing FRONT and CAMPAIGN and new SUBCAMPAIGN displayed but Unit is blank. All buttons are enabled
            1.2.6 Press UNIT button this can be after SubCampaign or on first load
                1.2.6.1 Display pop-up Form with a table with all <b>top-level</b> units on selected SubCampaign
                1.2.6.2 Select any Unit in table
                1.2.6.3 Record the COUNTRY for the Unit (from the table)
                1.2.6.3 Press SUBMIT - popup disappears
                1.2.6.4 Page rewritten with existing FRONT, CAMPAIGN and SUBCAMPAIGN and new Unit displayed. All buttons are enabled
            1.2.7 This can be repeated until the desired combination is achieved
            1.2.8 Press the SUBMIT button for the Form.
                1.2.8.1 If FRONT, CAMPAIGN and SUBCAMPAIGN are valid then update the sessionvars with the new data (FRONT, CAMPAIGN and SUBCAMPAIGN
                1.2.8.2 If UNIT and COUNTRY are valid then update the sessionvars with the new data for UNIT and COUNTRY
                1.2.8.3 Redisplay the page and remain on this page until another button is pressed
            1.2.9 Notes
                1.2.9.1 At any point you can change an earlier selection - but doing so loses all selections below the one changed as noted above
                1.2.9.2 e.g. if you change Front you lose Campaign, Subcampaign and Unit.  If you change Campaign you lose SubCampaign and Unit.
                        If you change Subcampaign you lose only the Unit
                1.2.9.3 If another navigation button is pressed at any time during this process then the sessionvars are <b>not</b> updated.
                        Thus it is permissable to leave the page safely at any time
                1.2.9.4 Once the page is left it is not possible to restore any previous partial attempts to change the sessionvars
            1.2.10 OTHER POSSIBILITIES
                1.2.10.1 Could JUST select Subcampaign and then Front and Campaign are filled in automatically
                1.2.10.2 Could Select Top Level Unit - but this could be in several subcampaigns so need to select which subcampaign 
                1.2.10.3 It might be possible to have a <b><u>FEW</u></b> presets for Front, Campaign and Subcampaign
                         - selected by Subcampaign and then Front and Campaign are filled in automatically
                1.2.10.4 Preset SUBCAMPAIGNS should include the top level of each of the 12 FRONTS
                         i.e. Western Front; Northern Front; Eastern Front; Southern Front; African Front; Middle East Front; Far East Front; Pacific Front; General Forces; World Politics; 
                         World Civil; World Weather
                1.2.10.5 Add introduction to give instructions.
                1.2.10.6 
                1.2.10.7 
                1.2.10.8 
                1.2.10.9 Could include all these options and not the main description!!!!  i.e. sElect only by Subcampaign
                
        <strong> 1.3 Exit Conditions</strong>
            1.3.1 None - can always exit = any partially completed selection will be lost.
                
    </pre>


</div>

</body>
</html>