<!DOCTYPE html>
<html style="background-color:white;">
	<head>
		<title>
		Updating
		</title>
		
		<link  type="text/css" rel="stylesheet" href="stylesheets/stylesheetCheck.css"/>
		<script type="text/javascript" src="scripts/jquery-1.11.1.js"></script>
		<script type="text/javascript" src="scripts/error.js"></script>
		
	<head/>
	
	<body>
	
	
		<script type="text/javascript">
				
		
		function reg(){
			window.location.href='register.php';
		}
		
		function() log{
			window.location.href='loggedOn.php';
		}
		

		</script>
		
		
		<?php
			session_start();			
			
			$itemname = $_POST['item'];
			$item_code = $_POST['code'];
			$amount = $_POST['amount'];	
			$desc = $_POST['description'];
			$newname = $_POST['new_item'];			
			$user = $_SESSION["EmpName"];	
			
			
			//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----
			
			if($amount < 0){
				header("Location: ../overview.php?error=15");
				break;
			}
			
		
			if($item_code != ""){
					$query = mysql_query("UPDATE item_table SET item_code = '$item_code' WHERE item_name = '$itemname';");
			}
			
			if($amount != ""){
				$query = mysql_query("UPDATE item_table SET unit_price = '$amount' WHERE item_name = '$itemname';");
			}
			
			if($desc != ""){
				$query = mysql_query("UPDATE item_table SET description = '$desc' WHERE item_name = '$itemname';");
			}
					
			if($newname != ""){
				$query = mysql_query("UPDATE item_table SET item_name = '$newname' WHERE item_name = '$itemname';");
			}
				
			$logquery = mysql_query("CALL item_log ('$itemname', '$user', 'Updated (to:)', '$newname', '$itemname');");
			header("Location: ../overview.php?success=9");
		?>	
	</body>
	
	
	
	
	
	
	
	
	
</html>