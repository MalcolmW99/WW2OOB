<?php

/**
 * @author 
 * @copyright 2013
 */

Function dt2dmy($arg_1)
	{
		$temp = strtotime($arg_1);
		$return = date("d-M-Y",$temp);

		return $return;	
	}
    
Function connectdb()
    {
        $host = "127.0.0.1";
        $user = "root";
        $pass = "nortonjuxta";
        $dbase = "ww2db";

        $conn = mysql_connect($host, $user, $pass) or die (mysqli_error());
        
        $selected = mysql_select_db($dbase, $conn);
        
        return ($selected);      
   }


?>