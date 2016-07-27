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
			
			$item_id = $_POST['item'];
			$user = $_SESSION["EmpName"];
			$add = $_POST['quantityAdd'];	
			$sub = $_POST['quantitySubtract'];
			
			if($add == ""){
				$add = 0;
			}
			if($sub == ""){
				$sub = 0;
			}
			
			if($item_id == ""){
				header("Location: ../manipulation.php?error=6");
				break;
			}
			
			if($item_id == ""|| !is_numeric($add) || !is_numeric($sub)){
				header("Location: ../manipulation.php?error=7");
				break;
			}
			
			//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----
			
			$checkItemID = mysql_query("SELECT item_name from item_table WHERE item_name = '$item_id'");
			
			if (mysql_num_rows($checkItemID) == 0) {
				header("Location: ../manipulation.php?error=8");
				break;
			}
			
			if(($sub == "")){
				$query = mysql_query("CALL add_item_quantity ('$item_id', '$add');");
				$query = mysql_query("CALL item_log ('$item_id', '$user', 'Added', '$add');");
				echo add;
				header("Location: ../manipulation.php?success=5");
			}
			else if($add == ""){
				
	
				$result = mysql_query("SELECT quantity FROM item_table WHERE item_name = '$item_id'");
				$row = mysql_fetch_assoc($result);
				
				if($sub > $row['quantity']){
					header("Location: ../manipulation.php?error=10");
					break;
				}
				
				$query = mysql_query("CALL subtract_item_quantity ('$item_id', '$sub');");
				$query = mysql_query("CALL item_log ('$item_id', '$user', 'Deducted', '$sub');");
				echo $sub;
				header("Location: ../manipulation.php?success=6");
			}
			

		?>	
	</body>
	
	
</html>