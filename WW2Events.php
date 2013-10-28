<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
<title>WW2 Website - Events</title>
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
<script>
$(document).ready(function() {
    $('#dateeventsstart').dataTable({
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 25,
			 "aoColumnDefs": [
			{ "sWidth": "750px", "aTargets": [ 4 ] }
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
   }).columnFilter({sPlaceHolder: "head:after",
				aoColumns: [ 
					 { sSelector: "#StartBookNoFilter" },
				     { sSelector: "#StartSubCampaignFilter" },
					 { sSelector: "#StartCampaignFilter" },
					 { sSelector: "#StartFrontFilter" },
					 { sSelector: "#StartCommentsFilter" },
					 { sSelector: "#StartLevelFilter", type: "number-range" }
				]});
});
</script>
<script>
$(document).ready(function() {
    $('#dateeventsend').dataTable({
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 25,
			 "aoColumnDefs": [
			{ "sWidth": "750px", "aTargets": [ 4 ] }
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
   }).columnFilter({sPlaceHolder: "head:after",
				aoColumns: [ 
					 { sSelector: "#EndBookNoFilter" },
				     { sSelector: "#EndSubCampaignFilter" },
					 { sSelector: "#EndCampaignFilter" },
					 { sSelector: "#EndFrontFilter" },
					 { sSelector: "#EndCommentsFilter" },
					 { sSelector: "#EndLevelFilter", type: "number-range" }
				]});
});
</script>
<script>
$(document).ready(function() {
    $('#dateeventshappen').dataTable({
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 25,
			 "aoColumnDefs": [
			{ "sWidth": "750px", "aTargets": [ 4 ] }
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
   }).columnFilter({sPlaceHolder: "head:after",
				aoColumns: [ 
					 { sSelector: "#HappenBookNoFilter" },
				     { sSelector: "#HappenSubCampaignFilter" },
					 { sSelector: "#HappenCampaignFilter" },
					 { sSelector: "#HappenFrontFilter" },
					 { sSelector: "#HappenCommentsFilter" },
					 { sSelector: "#HappenLevelFilter", type: "number-range" }
				]});
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

This is the <B>EVENTS</B> page <br><br>
        

<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Starting On</a></li>
			<li><a href="#tabs-2">Ending On</a></li>
			<li><a href="#tabs-3">During</a></li>
		</ul>
	<div id="tabs-1">
	<!-- Filter Table Start-->
	<h1> Events Starting on <?php echo $DateSelected; ?></h1>
		<table class = 'center' id='Table1'>
			<thead>
				<tr>
					<th>Book No</th>
					<th>Sub Campaign</th>
					<th>Campaign</th>
					<th>Front</th>
					<th>Comments</th>
					<th>Level No</th>
				</tr>
			</thead>
			<tbody>
				<tr id="filter_global">
					<td id="StartBookNoFilter"></td>
					<td id='StartSubCampaignFilter'></td>
					<td id='StartCampaignFilter'></td>
					<td id='StartFrontFilter'></td>					
					<td id='StartCommentsFilter'></td>
					<td id='StartLevelFilter'></td>
				</tr>
			</tbody>
		</table>
		<br>

<?php
		echo "<br>";
		// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$SQL = sprintf("Select booklist.Book_No, `keyword sub campaign list`.Sub_Campaign, keyword_campaign_list.`Campaign Keyword`, keywordfrontlist.Front, memo.Comments,
		memo.`Level No`, dateref.Date, dateref.End_Date
		From dateref Inner Join `keyword sub campaign list` On dateref.Sub_Campaign = `keyword sub campaign list`.SubCampaignID
		Inner Join memo On dateref.Memo_ID = memo.`Entry Number`
		Inner Join booklist On dateref.Book_ID = booklist.Book_Index
		Inner Join keyword_campaign_list On `keyword sub campaign list`.CampaignID = keyword_campaign_list.Campaign_ID
		Inner Join keywordfrontlist On keyword_campaign_list.`Front ID` = keywordfrontlist.FrontID
		Where '%s' = dateref.Date
		Order By memo.`Level No`, `keyword sub campaign list`.Sub_Campaign" , mysql_real_escape_string($datesel));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "Event sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No events on date
			{echo "<p class='centre'>No Events Found on $DateSelected</p>";}
		else
//		Events on this date
			{
//echo "debug books";
		echo"<br>";
			echo "<table id = 'dateeventsstart' class = 'center'>";
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
										echo "<a href='book.php?book=$value'>$value</a>";
											break;
										case 3:
										case 4:
											echo $value;
											break;										
										case 2:
											echo "<a href='displaycampaign.php?cmpgn=$value'>$value</a>";
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
</div>
<div id="tabs-2">
	<h1> Events Ending on <?php echo"$DateSelected"; ?> </h1>
	<!-- Filter Table End-->
		<table class = 'center' id='Table2'>
			<thead>
				<tr>
					<th>Book No</th>
					<th>Sub Campaign</th>
					<th>Campaign</th>
					<th>Front</th>
					<th>Comments</th>
					<th>Level No</th>
				</tr>
			</thead>
			<tbody>
				<tr id="filter_global">
					<td id="EndBookNoFilter"></td>
					<td id='EndSubCampaignFilter'></td>
					<td id='EndCampaignFilter'></td>
					<td id='EndFrontFilter'></td>					
					<td id='EndCommentsFilter'></td>
					<td id='EndLevelFilter'></td>
				</tr>
			</tbody>
		</table>
		<br>
<?php
		echo "<br>";
		// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$SQL = sprintf("Select booklist.Book_No, `keyword sub campaign list`.Sub_Campaign, keyword_campaign_list.`Campaign Keyword`, keywordfrontlist.Front, memo.Comments,
		memo.`Level No`, dateref.Date, dateref.End_Date
		From dateref Inner Join `keyword sub campaign list` On dateref.Sub_Campaign = `keyword sub campaign list`.SubCampaignID
		Inner Join memo On dateref.Memo_ID = memo.`Entry Number`
		Inner Join booklist On dateref.Book_ID = booklist.Book_Index
		Inner Join keyword_campaign_list On `keyword sub campaign list`.CampaignID = keyword_campaign_list.Campaign_ID
		Inner Join keywordfrontlist On keyword_campaign_list.`Front ID` = keywordfrontlist.FrontID
		Where dateref.End_Date = '%s'
		Order By memo.`Level No`, `keyword sub campaign list`.Sub_Campaign", mysql_real_escape_string($datesel));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "Event sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No events on date
			{echo "<p class='centre'>No Events Found ending on $DateSelected</p>";}
		else
//		Events on this date
			{
//echo "debug books";
		echo"<br>";
			echo "<table id = 'dateeventsend' class = 'center'>";
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
										echo "<a href='book.php?book=$value'>$value</a>";
											break;
										case 3:
										case 4:
											echo $value;
											break;										
										case 2:
											echo "<a href='displaycampaign.php?cmpgn=$value'>$value</a>";
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
</div>
<div id="tabs-3">
	<h1> Events happening on <?php echo"$DateSelected"; ?> </h1>
	<!-- Filter Table End-->
		<table class = 'center' id='Table3'>
			<thead>
				<tr>
					<th>Book No</th>
					<th>Sub Campaign</th>
					<th>Campaign</th>
					<th>Front</th>
					<th>Comments</th>
					<th>Level No</th>
				</tr>
			</thead>
			<tbody>
				<tr id="filter_global">
					<td id="HappenBookNoFilter"></td>
					<td id='HappenSubCampaignFilter'></td>
					<td id='HappenCampaignFilter'></td>
					<td id='HappenFrontFilter'></td>					
					<td id='HappenCommentsFilter'></td>
					<td id='HappenLevelFilter'></td>
				</tr>
			</tbody>
		</table>
		<br>

<?php
	echo "<br>";
		// Database is opened in header.php
		$datesel = dt2ymd($DateSelected);
		$SQL = sprintf("Select booklist.Book_No, `keyword sub campaign list`.Sub_Campaign, keyword_campaign_list.`Campaign Keyword`, keywordfrontlist.Front, memo.Comments,
		memo.`Level No`, dateref.Date, dateref.End_Date
		From dateref Inner Join `keyword sub campaign list` On dateref.Sub_Campaign = `keyword sub campaign list`.SubCampaignID
		Inner Join memo On dateref.Memo_ID = memo.`Entry Number`
		Inner Join booklist On dateref.Book_ID = booklist.Book_Index
		Inner Join keyword_campaign_list On `keyword sub campaign list`.CampaignID = keyword_campaign_list.Campaign_ID
		Inner Join keywordfrontlist On keyword_campaign_list.`Front ID` = keywordfrontlist.FrontID
		Where '%s' BETWEEN dateref.Date AND dateref.End_Date
		Order By memo.`Level No`, `keyword sub campaign list`.Sub_Campaign" , mysql_real_escape_string($datesel));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "Event sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No events on date
			{echo "<p class='centre'>No Events Found on $DateSelected</p>";}
		else
//		Events on this date
			{
//echo "debug books";
		echo"<br>";
			echo "<table id = 'dateeventshappen' class = 'center'>";
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
										echo "<a href='book.php?book=$value'>$value</a>";
											break;
										case 3:
										case 4:
											echo $value;
											break;										
										case 2:
											echo "<a href='displaycampaign.php?cmpgn=$value'>$value</a>";
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
</div>
</div>

    <pre>
        <strong> 1.Programming Notes</strong>
        <strong> 1.1 Load Pre-Conditions</strong>
            1.1.1 'Selected Date' must be set
            1.1.2 'Selected Unit' must be set
            1.1.3 'SubCampaign' must be set (so that 'Start Date' and 'End Date' are valid
            1.1.4 'SubCampaign' being set implies that 'Front' and 'Campaign' must also be set
            1.1.5 To filter by Country then 'Selected Country' must be set
            1.1.6 If any of the first three conditions is not met then an error is displayed instead of the contents of the page
        <strong> 1.2 Notes on design</strong>
            1.2.1 Can <u>not</u> change 'Selected Unit' from this page
            1.2.2 Can <u>not</u> change 'SubCampaign', 'Campaign' and 'Front' from this page
            1.2.3 Can change 'Selected Date' within range Start Date to End Date - this also changes 'Selected Date' in ww2db.sessionvars
            1.2.4 Can filter events by: 'Front', 'Campaign', 'Sub Campaign', 'Country', 'Month', 'Keyword Type'
            1.2.5 Each filter uses its own subpage - with the appropriate condition checked before display
    </pre>
</div>

<?php
//TEST to check scope of variables in included files

echo "This is a test print Country selected = " .$CountrySelected;
echo $CountrySelected;
?>
<!--<?php include("includes/header.html");?>-->

</body>
</html>