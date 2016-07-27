<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="withstyle.css"/>
		<title>Dropping</title>
		
			<script type="text/javascript" src="scripts/jquery-1.11.1.js"></script>
			<script type="text/javascript" src="scripts/error.js"></script>
		
	</head>
	<body>
	
		<?php
			session_start();
			
			$item_id = $_POST['item'];
			$user = $_SESSION["EmpName"];
									
			if($item_id == ""){
				header("Location: ../overview.php?error=6");
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
				header("Location: ../overview.php?error=8");
				break;
			}
			
			mysql_query("CALL remove_item ('$item_id');");
			$query = mysql_query("CALL item_log ('$item_id', '$user', 'Deleted', 'N/A');");
			
			header("Location: ../overview.php?success=4");
		?>
		
	</body>
</html>