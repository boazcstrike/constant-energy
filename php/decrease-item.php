<?php
		session_start();
		//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
		//----

		$itemname = $_POST["itemchosen"];
		$quantity = $_POST["quantity"];
		$ref = $_POST["reference"];
		$user = $_SESSION["EmpName"];
		
		$results = mysql_query("SELECT quantity FROM item_table WHERE item_name = '$itemname'");
		$row = mysql_fetch_array($results);
		
		if(!is_numeric($quantity)){
				header("Location: ../overview.php?error=14");
				break;
			}	
		
		if($quantity > $row['quantity']){
				header("Location: ../overview.php?error=13");
				break;
			}	
			
			if($quantity < 0){
				header("Location: ../overview.php?error=15");
				break;
			}	
			
		if($ref == ""){
			header("Location: ../overview.php?error=7");
			break;
		}
			
		$results = mysql_query("SELECT quantity FROM item_table WHERE item_name = '$itemname'");
		$row = mysql_fetch_array($results);
		
		$prev = $row['quantity'];
		
		$query = mysql_query("CALL subtract_item_quantity ('$itemname', $quantity);");
		$logquery = mysql_query("CALL item_log ('$itemname', '$user', 'Deducted', '$quantity', '$prev', null, '$ref');");
		header("Location: ../overview.php?success=6");
		break;
	?>



