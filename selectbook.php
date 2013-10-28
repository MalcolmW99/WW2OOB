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
    $('#booklist').dataTable({
			"bAutoWidth": false,
			"bLengthChange": false,
			"iDisplayLength": 25,
			 "aoColumnDefs": [
			{ "sWidth": "100px", "aTargets": [ 0,1,2,3,4,5 ] }
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
					 { sSelector: "#BookNoFilter" },
				     { sSelector: "#TitleFilter" },	
					 { sSelector: "#BookTypeFilter" },
					 { sSelector: "#AuthorFilter" },
					 { sSelector: "#Author2Filter" },
					 { sSelector: "#PublisherFilter" }
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
    This is the <b>Select Book</b> page <br><br>


	<h3 class='centre'>List of all WW2 Reference Books</h3>
	<br>


<!-- Filter Table -->
		<table class = 'center' id='Table1'>
			<thead>
				<tr>
					<th>Book No</th>
					<th>Title</th>
					<th>Book Type</th>
					<th>Author</th>
					<th>Author 2</th>
					<th>Publisher</th>

				</tr>
			</thead>
			<tbody>
				<tr id="filter_global">
					<td id="BookNoFilter"></td>
					<td id='TitleFilter'></td>
					<td id='BookTypeFilter'></td>
					<td id='AuthorFilter'></td>
					<td id='Author2Filter'></td>
					<td id='PublisherFilter'></td>
				</tr>
			</tbody>
		</table>
		<br>

<?php		
// 		Database is opened in header.php
//		Events in this book
		echo"<br>";		
		$SQL = sprintf("Select booklist.Book_No, booklist.Title, booklist.Book_Type, author.Author, author1.Author As Author1, publisher.Publisher 
		FROM booklist Inner Join author On booklist.Author_1ID = author.AuthorID
		Left Join author author1 On booklist.Author_2ID = author1.AuthorID
		Inner Join publisher On booklist.Publisher_ID = publisher.Publisher_ID
		Order By booklist.Book_No");
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
		echo "Row Count: $row_cnt";

// entries found
//echo "debug books";
			echo "<table id = 'booklist' class = 'center'>";
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
										case 2:
										case 3:
										case 4:
										case 5:
										case 6:
											echo $value;
											break;										
									}
								echo "</td>";
							}
						echo "</tr>";
					}
				echo "</tbody>";
			echo "</table>";
		echo"<br>";
?>

<!--<?php include("includes/header.html");?>-->

</body>
</html>