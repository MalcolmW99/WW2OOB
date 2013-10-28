<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head>
<title>WW2 Website - Book</title>
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
$(document).ready(function() {
    $('#bookevents').dataTable({
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 25,
			 "aoColumnDefs": [
			{ "sWidth": "40px", "aTargets": [ 0,1,2,3 ] }
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
					 { sSelector: "#StartPageFilter" },
				     { sSelector: "#StartParaFilter" },	
					 { sSelector: "#EndPageFilter" },
					 { sSelector: "#EndParaFilter" },
					 { sSelector: "#SubCampaignFilter" },
					 { sSelector: "#CommentsFilter" },
					 { sSelector: "#LevelFilter", type: "number-range" }
				]});
});
</script>

</head>

<body>
	<p>testing</p>
	<div class = 'header'>
	<?php
		include ("includes/sqllibrary.php");
		include ("includes/navigation.php");
		include ("includes/header.php");
?>
</div>
<div class = 'content'>
    This is the <b>Book</b> page <br><br>

<?php
		// Is an argument passed?
		if (isset($_GET['book']))
		{ 	$book = $_GET['book'];}
		echo "<h3 class='centre'>Detail of $book</h3>";
		echo "<br>";
		// Database is opened in header.php
		
		$SQL = sprintf("Select booklist.Book_No, booklist.Title, publisher.Publisher, author.Author, author1.Author As Author1 
		FROM booklist Left Join publisher On booklist.Publisher_ID = publisher.Publisher_ID
		Left Join author On booklist.Author_1ID = author.AuthorID
		Left Join author author1 On booklist.Author_2ID = author1.AuthorID
		Where booklist.Book_No = '%s'", mysql_real_escape_string($book));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "Book sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No such book
			{echo "<p class='centre'>Book Not Found</p>";}
		else
// entries found
			{
//echo "debug books";
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
										case 2:
											echo $value;
											$bTitle = $value;
											break;
										case 1:
										case 3:
										case 4:
										case 5:
											echo $value;
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
		
		echo "<h3 class='centre'>Events recorded from '$bTitle'</h3>";
		echo"<br>";
?>
<!-- Filter Table -->
		<table class = 'center' id='Table1'>
			<thead>
				<tr>
					<th>Start Page</th>
					<th>Start Para</th>
					<th>End Page</th>
					<th>End Para</th>
					<th>Sub Campaign</th>
					<th>Comments</th>
					<th>Level No</th>
				</tr>
			</thead>
			<tbody>
				<tr id="filter_global">
					<td id="StartPageFilter"></td>
					<td id='StartParaFilter'></td>
					<td id='EndPageFilter'></td>
					<td id='EndParaFilter'></td>
					<td id='SubCampaignFilter'></td>
					<td id='CommentsFilter'></td>
					<td id='LevelFilter'></td>
				</tr>
			</tbody>
		</table>
		<br>
<?php		

//		Events in this book
		echo"<br>";		
		$SQL = sprintf("Select dateref.Start_Page, dateref.Start_Para, dateref.End_Page, dateref.End_Para, `keyword sub campaign list`.Sub_Campaign, memo.Comments, memo.`Level No`,
		dateref.Date, dateref.End_Date, `keyword sub campaign list`.`Start Date` As SC_Start, `keyword sub campaign list`.`End Date` As SC_End
		From booklist Inner Join dateref On dateref.Book_ID = booklist.Book_Index
		Left Join `keyword sub campaign list` On dateref.Sub_Campaign = `keyword sub campaign list`.SubCampaignID
		Inner Join memo On dateref.Memo_ID = memo.`Entry Number`
		Where booklist.Book_No = '%s'
		Order By dateref.Date, dateref.End_Date", mysql_real_escape_string($book));
//		echo $SQL;
		$result = mysqli_query($selected, $SQL);
		if (!$result)
			{
				echo "Book sql failed<br>";
				printf("Errormessage: %s\n", mysqli_error($selected));
				mysqli_close($selected);
				die();
			}
		$row_cnt = mysqli_num_rows($result);
//		echo "Row Count: $row_cnt";
		if ($row_cnt == 0)
// No such book
			{echo "<p class='centre'>Book Not Found</p>";}
		else
// entries found
			{
//echo "debug books";
			echo "<table id = 'bookevents' class = 'center'>";
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
										case 6:
										case 7:
											echo $value;
											break;										
										case 5:
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
<div Style ='background: cyan'>
    <pre>
        <strong> 1 Programming Notes</strong>
        <strong> 1.1 Load Pre-Conditions</strong>
            1.1.1 'Selected Date' must be set
            1.1.2 'Selected Unit' must be set
            1.1.3 'SubCampaign' must be set (so that 'Start Date' and 'End Date' are valid
            1.1.3 If any condition is not met then an error is displayed instead of the contents of the page
         <strong> 1.2 Notes on design</strong>
            1.2.1 Can <u>not</u> change "Selected Unit" from this page
            1.2.2 But can change local 'unit' to drill down the OOB
            1.2.3 Can reset 'Unit' to 'Selected Unit'
            1.2.4 Can change 'Selected Date' within range Start Date to End Date - this also changes 'Selected Date' in ww2db.sessionvars
            1.2.5 Only includes a maximum of 3 levels in OOB at any one time - more can be displayed by selecting a unit in the first level
            1.2.6 There is no limit on Drilling down for a new unit
    </pre>
</div>
</div>

<!--<?php include("includes/header.html");?>-->

</body>
</html>