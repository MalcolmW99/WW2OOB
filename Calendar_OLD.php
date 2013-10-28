<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
	<head>
		<title>WW2 Website - Calendar</title>
		<link href="calendar/calendar.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="description" content="page description" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<script language="javascript" src="calendar/calendar.js"></script>
		<style type="text/css">@import "css/styles.css";</style>
	</head>

	<body>

	<pre>
		<form action="changedate.php"; method="post";>;
<?php
	include "includes/header.php";
	require_once('calendar/classes/tc_calendar.php');
?>
             <p class="largetxt"><b>DatePicker Style </b></p>
              <table border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td nowrap>Date 2 :</td>
                  <td><script language="javascript">
						<!--
						function myChanged(v){
							alert("Hello, value has been changed : "+document.getElementById("date1").value+"["+v+"]");
						}
						//-->
						</script>
                    <?php
					  $myCalendar = new tc_calendar("date1", true);
					  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
					  $myCalendar->setDate(date('01'), date('08'), date('1939'));
					  $myCalendar->setPath("calendar/");
					  $myCalendar->setYearInterval(1939, 1945);
					  $myCalendar->dateAllow('1939-01-01', '1945-12-31');
					  //$myCalendar->setHeight(350);
					  //$myCalendar->autoSubmit(true, "form1");
					  //$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-13", "2011-04-25"), 0, 'month');
					  $myCalendar->setOnChange("myChanged('test')");
					  //$myCalendar->rtl = true;
					  $myCalendar->writeScript();
					  ?></td>
                  <td><input type="button" name="button" id="button" value="Accept the value" onClick="javascript:alert(this.form.date1.value);"></td>
                </tr>
              </table>
	

	
?>
		</form>;
    </pre>

	
	<?php
		
		
		
		
		
		
		
		
		
	?>
	
		<div class = 'lty'>
			This is the <B>CALENDAR</B> page <br><br>
			<h1> Select New Date within range of Start Date to End Date</h1>
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