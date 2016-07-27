<?php
		session_start();
		//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
		//----

		$itemname = $_POST["item"];
		$base = $_POST["base"];
		$user = $_SESSION["EmpName"];
		
		if(!is_numeric($base)){
				header("Location: ../overview.php?error=14");
				break;
			}	
		
		if($base < 0){
				header("Location: ../overview.php?error=15");
				break;
			}	
			
		$results = mysql_query("SELECT baseline_quantity FROM item_table WHERE item_name = '$itemname'");
		$row = mysql_fetch_array($results);
		
		$prev = $row['baseline_quantity'];
		
		$query = mysql_query("CALL update_base ($base, '$itemname');");
		$logquery = mysql_query("CALL item_log ('$itemname', '$user', 'Updated Baseline', '$base', '$prev');");
		header("Location: ../overview.php?success=9");
		break;
	?>



