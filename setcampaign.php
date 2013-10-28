<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
	<head>
		<title>WW2 Website - Calendar</title>
		<meta http-equiv="description" content="page description" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<style type="text/css">@import "css/styles.css";</style>
	</head>

	<body>
	<?php
		include "includes/header.php";
	
		// Is an argument passed?
	if (isset($_GET['setcmpgn']))
		{ $subcampaign = $_GET['setcmpgn'];}
	else
		{	echo "<h1> No Sub Campaign Given</h1>";
			exit();
		}
	$datesel = dt2ymd($DateSelected);
	echo "<h3 class = 'centre'>Accept new SubCampaign?</h3>";
	echo "<p class = 'centre'>$subcampaign</p>";
	$sqlfront = sprintf("SELECT keyword_campaign_list.`Campaign Keyword` AS Campaign, keywordfrontlist.Front, `keyword sub campaign list`.`Start Date`, `keyword sub campaign list`.`End Date`
		FROM (`keyword sub campaign list` INNER JOIN keyword_campaign_list ON `keyword sub campaign list`.CampaignID = keyword_campaign_list.Campaign_ID) 
		INNER JOIN keywordfrontlist ON keyword_campaign_list.`Front ID` = keywordfrontlist.FrontID
		WHERE `keyword sub campaign list`.Sub_Campaign = '%s'", mysql_real_escape_string($subcampaign));
//echo $sqlfront;
	$frontresult = mysqli_query($selected, $sqlfront);
	if (!$frontresult)
	{	echo"Subcampaign Not Found";
		exit();
	}
	echo "<table class = 'center'>";
		echo "<thead>";
			echo "<tr>";
			$row = mysqli_fetch_assoc($frontresult);
			foreach ($row as $col => $value)
			{
				echo "<th>";
				echo $col;
				echo "</th>";
			}
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
	// Write rows
		mysqli_data_seek($frontresult, 0);
		$row = mysqli_fetch_assoc($frontresult);
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
						{ echo $value; }
						break;
		// date fields
					case 3:
						{if ($value) 
							{ echo dt2dmy($value);
							$StartDate = $value;}
						else echo "";}
						break;
					case 4:
						{if ($value) 
							{ echo dt2dmy($value);
							$EndDate = $value;}
						else echo "";
						break; }
				}
			echo "</td>";
		}
		echo "</tr>";
		echo "<tr>";
			echo "<td colspan='4'>.</td>";
		echo "</tr>";
		echo "<tr>";
//			echo "<td class='centre', colspan='2'><button type = 'button' onclick=<a href='updatedb.php?campgn=$subcampaign'></a>OK</td>"; // Add call to Jquery eventually 
			echo "<td class='centre', colspan='4'><button type = 'button' onclick=\"javascript:window.close();\">Cancel</td>";
		echo "</tr>";					
		echo "</tbody>";
	echo "</table>";
//		$db_field = mysqli_fetch_assoc($frontresult);

			echo " Start Date is: $StartDate";
			echo "<br>";
			$StartDate = dt2dmy($StartDate);
			echo " End Date is: $EndDate";
			echo "<br>";
			$EndDate = dt2dmy($dates);
			if (!$DateSelected)					
				{	$DateSelected = $StartDate; 
					echo "**1**";
				}
			if (dt2ymd($DateSelected) < dt2ymd($StartDate))
				{	$DateSelected = $StartDate; 
					echo "**2**";
				}
			if (dt2ymd($DateSelected) > dt2ymd($EndDate))
				{	$DateSelected = $EndDate; 
					echo "**3**";
				}
	
			echo "<br>3:";
			echo $DateSelected;
			echo "<br>4:";
			echo $datesel;
			
			
		$updatesql = sprintf("UPDATE sessionvars SET sessionvars.CurrentDate = '%s' , sessionvars.SubCampaign = '%s' 
					WHERE (((sessionvars.User)='malcolm'));", mysql_real_escape_string($datesel), mysql_real_escape_string($subcampaign));
//		echo $updatesql;

		$updateresult = mysqli_query($selected, $updatesql);
		
	?>
<script type='text/javascript'>
	self.close();
</script>
	
		<div class = 'lty'>
			This is the <B>Set Sub Campaign</B> page <br><br>

			<pre class = temp>
				<strong> 1 Programming Notes</strong>
					<strong> 1.1 Load Pre-Conditions</strong>
							1.1.1 'Selected Date' must be set
							1.1.2 'SubCampaign' must be set (so that 'Start Date' and 'End Date' are valid
							1.1.3 If any condition is not met then an error is displayed instead of the page
            
					<strong> 1.2 Notes on design</strong>
							1.2.1 The 'Date' can be changed by + or - : 1 day; 1 month; 1 year.
							1.2.2 The 'Date' can only be changed within the 'Start Date' and 'End Date' limits
							1.2.3 The 'Date' is only posted to the sessionvars when a 'Submit' button is pressed
							1.2.4 Can  manually input a date
							1.2.5 This is not a stand-alone page but can only be called as a pop-up.
            
					<strong> 1.3 'Submit' button checks on exit before updating 'Selected Date'</strong>
							1.3.1 New 'Date' is <> 'Selected Date' - if it is = no error but a warning is given that the date has not been changed.
							1.3.2 New 'Date' is >= 'Start Date' - if < then error raised and no change made
							1.3.3 New 'Date' is <= 'End Date' - if > then error raised and no change mad
							1.3.4 If all checks pass then 'Selected Date' is updated to new 'Date' and remain on this page until another navigation button is pressed

			</pre>
		</div>
	</body>
</html>