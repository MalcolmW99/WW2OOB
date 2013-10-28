<?php

/**
 * @author 
 * @copyright 2013
 */

Function dt2dmy($arg_1)
	{
		$temp = strtotime($arg_1);
		if ($temp)
			{ $return = date("d-M-Y",$temp);}
		else
			{ $return = $arg_1;}

		return $return;	
	}
	Function dt2ymd($arg_1)
	{
		$temp = strtotime($arg_1);
		$return = date("Y-m-d",$temp);

		return $return;
	}
		
Function connectdb()
    {
        $host = "127.0.0.1";
        $user = "root";
        $pass = "nortonjuxta";
        $dbase = "ww2db";
//        global $conn;
        $selected = mysqli_connect($host, $user, $pass, $dbase);
		if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
        
//        $selected = mysql_select_db($dbase, $conn);
        
        return ($selected);
   }
   
Function getfront($sel)
    {
        $frontvalue = $sel.value;
        return $frontvalue;
    }
Function getOOBOp ($unit, $chosenDate, $level, $selected)
	{	
		$nxtlevel = $level;
		$nxtlevel++;
		if ($nxtlevel == 5)
			{return;}
		$SQL = sprintf("Select unit.Unit, unit1.Unit As Unit1, `unit type`.`Level No`, unit1.`Unit Number`, person.`Full Name`,location.Location, 
				status.Status, unitstatus.Comment, 
				unithigh.`Start Date`, unithigh.`End Date`, unitco.`Start Date` As `COSD`, unitco.`End Date` As `COED`,
				unitlocn.`Start Date` As `LocnSD`, unitlocn.`End Date` As `LocnED`
				From unithigh Inner Join unit On unithigh.`Higher ID` = unit.Unit_ID
				Inner Join unit unit1 On unithigh.`Unit ID` = unit1.Unit_ID
				Inner Join `unit type` On unit1.`Unit Type` = `unit type`.`Unittype ID`
				Inner Join unitco On unitco.`Unit ID` = unit1.Unit_ID 
				Inner Join unitlocn On unitlocn.`Unit ID` = unit1.Unit_ID
				Inner Join person On unitco.`Person ID` = person.ID 
				Inner Join location On unitlocn.`Location ID` = location.LocID
				Inner Join unitstatus On unit1.Unit_ID = unitstatus.Unit
				Inner Join status On unitstatus.Status = status.StatusID
				Where unit.Unit = '%s' AND '%s' BETWEEN unithigh.`Start Date` AND unithigh.`End Date`
				AND '%s' BETWEEN unitco.`Start Date` AND unitco.`End Date`
				AND '%s' BETWEEN unitlocn.`Start Date` AND unitlocn.`End Date`
				AND '%s' BETWEEN unitstatus.`Start Date` AND unitstatus.`End Date`
				AND unitco.`Rank Index` = 1 AND unithigh.`Higher Type` LIKE '%s'
				Order By `unit type`.`Level No`, unit1.`Unit Number`",
				mysql_real_escape_string($unit), mysql_real_escape_string($chosenDate), mysql_real_escape_string($chosenDate),
				mysql_real_escape_string($chosenDate), mysql_real_escape_string($chosenDate), 'Operational%');
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
		if 	($row_cnt == 0)	
			{return;}
// Write row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{

						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								switch ($j)
								{
									case 1:
										break;
									case 2:
										$nxtunit = $value;
										echo "<li><a href='displayunit.php?unit=$value'>$value</a>";
										break;
									case 3:
									case 4:
										break;
									case 5:
										echo " (<a href='person.php?person=$value'>$value</a>)";
										break;
									case 6:
										echo " @ <a href='location.php?locn=$value'>$value</a>";
										break;
									case 7:
										echo " Status: $value";
										break;
									case 8:
										echo " $value</li>";
										break;
								}
							}
						echo "<ul>";
						getOOBOp ($nxtunit, $chosenDate, $nxtlevel, $selected);
						echo "</ul>";
					}

		return;
	}
Function getOOBAdmin ($unit, $chosenDate, $level, $selected)
	{	
		$nxtlevel = $level;
		$nxtlevel++;
		if ($nxtlevel == 5)
			{return;}
		$SQL = sprintf("Select unit.Unit, unit1.Unit As Unit1, `unit type`.`Level No`, unit1.`Unit Number`, person.`Full Name`,location.Location,
				status.Status, unitstatus.Comment, 
				unithigh.`Start Date`, unithigh.`End Date`, unitco.`Start Date` As `COSD`, unitco.`End Date` As `COED`,
				unitlocn.`Start Date` As `LocnSD`, unitlocn.`End Date` As `LocnED`
				From unithigh Inner Join unit On unithigh.`Higher ID` = unit.Unit_ID
				Inner Join unit unit1 On unithigh.`Unit ID` = unit1.Unit_ID
				Inner Join `unit type` On unit1.`Unit Type` = `unit type`.`Unittype ID`
				Inner Join unitco On unitco.`Unit ID` = unit1.Unit_ID 
				Inner Join unitlocn On unitlocn.`Unit ID` = unit1.Unit_ID
				Inner Join person On unitco.`Person ID` = person.ID 
				Inner Join location On unitlocn.`Location ID` = location.LocID
				Inner Join unitstatus On unit1.Unit_ID = unitstatus.Unit
				Inner Join status On unitstatus.Status = status.StatusID
				Where unit.Unit = '%s' AND '%s' BETWEEN unithigh.`Start Date` AND unithigh.`End Date`
				AND '%s' BETWEEN unitco.`Start Date` AND unitco.`End Date`
				AND '%s' BETWEEN unitlocn.`Start Date` AND unitlocn.`End Date` AND unitco.`Rank Index` = 1
				AND '%s' BETWEEN unitstatus.`Start Date` AND unitstatus.`End Date` AND unithigh.`Higher Type` LIKE '%s'
				Order By `unit type`.`Level No`, unit1.`Unit Number`",
				mysql_real_escape_string($unit), mysql_real_escape_string($chosenDate), mysql_real_escape_string($chosenDate),
				mysql_real_escape_string($chosenDate), mysql_real_escape_string($chosenDate), '%Admin');
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
		if 	($row_cnt == 0)	
			{return;}
// Write row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{

						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								switch ($j)
								{
									case 1:
										break;
									case 2:
										$nxtunit = $value;
										echo "<li><a href='displayunit.php?unit=$value'>$value</a>";
										break;
									case 3:
									case 4:
										break;
									case 5:
										echo " (<a href='person.php?person=$value'>$value</a>)";
										break;
									case 6:
										echo " @ <a href='location.php?locn=$value'>$value</a>";
										break;
									case 7:
										echo " Status: $value";
										break;
									case 8:
										echo " $value</li>";
										break;
								}
							}
						echo "<ul>";
						getOOBAdmin ($nxtunit, $chosenDate, $nxtlevel, $selected);
						echo "</ul>";
					}

		return;
	}

Function getOOBSimple ($unit, $chosenDate, $level, $selected)
	{	
		$nxtlevel = $level;
		$nxtlevel++;
		if ($nxtlevel == 5)
			{return;}
		$SQL = sprintf("Select unit.Unit, unit1.Unit As Unit1, `unit type`.`Level No`, unit1.`Unit Number`, unithigh.`Higher Type`,
				unithigh.`Start Date`, unithigh.`End Date`
				From unithigh Inner Join unit On unithigh.`Higher ID` = unit.Unit_ID
				Inner Join unit unit1 On unithigh.`Unit ID` = unit1.Unit_ID
				Inner Join `unit type` On unit1.`Unit Type` = `unit type`.`Unittype ID`
				Where unit.Unit = '%s' AND '%s' BETWEEN unithigh.`Start Date` AND unithigh.`End Date`
				Order By `unit type`.`Level No`, unit1.`Unit Number`",
				mysql_real_escape_string($unit), mysql_real_escape_string($chosenDate));
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
		if 	($row_cnt == 0)	
			{return;}
// Write row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{

						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								switch ($j)
								{
									case 1:
										break;
									case 2:
										$nxtunit = $value;
										echo "<li><a href='displayunit.php?unit=$value'>$value</a>";
										break;
									case 3:
									case 4:
										break;
									case 5:
									echo "  Link type: $value </li>";
										break;
								}
							}
						echo "<ul>";
						getOOBSimple ($nxtunit, $chosenDate, $nxtlevel, $selected);
						echo "</ul>";
					}

		return;
	}
Function getOOBPseudo ($unit, $chosenDate, $level, $selected)
	{	
		$nxtlevel = $level;
		$nxtlevel++;
		if ($nxtlevel == 5)
			{return;}
		$SQL = sprintf("Select unit.Unit, unit1.Unit As Unit1, `unit type`.`Level No`, unit1.`Unit Number`, unithigh.`Higher Type`,
				unithigh.`Start Date`, unithigh.`End Date`
				From unithigh Inner Join unit On unithigh.`Higher ID` = unit.Unit_ID
				Inner Join unit unit1 On unithigh.`Unit ID` = unit1.Unit_ID
				Inner Join `unit type` On unit1.`Unit Type` = `unit type`.`Unittype ID`
				Where unit.Unit = '%s' AND '%s' BETWEEN unithigh.`Start Date` AND unithigh.`End Date`
				AND unithigh.`Higher Type` LIKE '%s'
				Order By `unit type`.`Level No`, unit1.`Unit Number`",
				mysql_real_escape_string($unit), mysql_real_escape_string($chosenDate), 'Pseudo');
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
		if 	($row_cnt == 0)	
			{return;}
// Write row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{

						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								switch ($j)
								{
									case 1:
										break;
									case 2:
										$nxtunit = $value;
										echo "<li><a href='displayunit.php?unit=$value'>$value</a>";
										break;
									case 3:
									case 4:
										break;
								}
							}
						echo "<ul>";
						getOOBPseudo ($nxtunit, $chosenDate, $nxtlevel, $selected);
						echo "</ul>";
					}

		return;
	}


Function getOOBConstruction ($unit, $chosenDate, $level, $selected)
	{	
		$nxtlevel = $level;
		$nxtlevel++;
		if ($nxtlevel == 5)
			{return;}
		$SQL = sprintf("Select unit.Unit, unit1.Unit As Unit1, `unit type`.`Level No`, unit1.`Unit Number`, unithigh.`Higher Type`,
				unithigh.`Start Date`, unithigh.`End Date`
				From unithigh Inner Join unit On unithigh.`Higher ID` = unit.Unit_ID
				Inner Join unit unit1 On unithigh.`Unit ID` = unit1.Unit_ID
				Inner Join `unit type` On unit1.`Unit Type` = `unit type`.`Unittype ID`
				Where unit.Unit = '%s' AND '%s' BETWEEN unithigh.`Start Date` AND unithigh.`End Date`
				AND unithigh.`Higher Type` LIKE '%s'
				Order By `unit type`.`Level No`, unit1.`Unit Number`",
				mysql_real_escape_string($unit), mysql_real_escape_string($chosenDate), 'Construction');
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
		if 	($row_cnt == 0)	
			{return;}
// Write row
					mysqli_data_seek($result, 0);
					while ($row = mysqli_fetch_assoc($result)) 
					{

						$j = 0;
						foreach($row as $key => $value)
							{
								$j++;
								switch ($j)
								{
									case 1:
										break;
									case 2:
										$nxtunit = $value;
										echo "<li><a href='displayunit.php?unit=$value'>$value</a>";
										break;
									case 3:
									case 4:
										break;
								}
							}
						echo "<ul>";
						getOOBConstruction ($nxtunit, $chosenDate, $nxtlevel, $selected);
						echo "</ul>";
					}

		return;
	}

	?>