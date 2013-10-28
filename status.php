<?php
		echo "<h3 class ='centre'> Status </h3>";
		echo"<br>";
	
// Display status for selected unit from unitstatus table

		$SQL = sprintf("SELECT unitstatus.`Seq No`, status.Status, unit.Unit as `Unit changed`, unitstatus.Comment, unitstatus.`Start Date`, unitstatus.`End Date` 
		FROM unitstatus LEFT JOIN status ON unitstatus.status=status.StatusID
		LEFT JOIN unit on unitstatus.`unit changed`=unit.Unit_ID
		WHERE unitstatus.Unit='%s' ORDER BY unitstatus.`Seq No`", mysql_real_escape_string($unitid));
//		echo $statusSQL;
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
		if ($row_cnt = 0)
			// No status data found
			{ echo "<p class=centre>No Status Data Found</p>";}
		else
		{
			echo"<br>";
			
			echo "<table class = 'center'>";
				echo "<thead>";
					echo "<tr>";
//						echo "debug002";
						$row = mysqli_fetch_assoc($result);
						foreach ($row as $col => $value)
						{
//							echo "debug004";
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
							switch ($j)
							{
								case 1:
								case 2:
								case 3:
								case 4:
									echo $value;
									break;
								default:	// date fields
									if ($value) 
										{ echo dt2dmy($value);}
									else echo "";
							}

							echo "</td>";
						}
						echo "</tr>";
					}
				echo "</tbody>";

				echo "</table>";
		}
?>

