<!DOCTYPE html>
<html style="background-color:white;">
	<head>
		<title>
		Adding
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
			$item_code = $_POST['code'];
			$qty = $_POST['qty'];	
			$amount = $_POST['amount'];	
			$base = $_POST['base'];	
			$desc = $_POST['description'];	
			$user = $_SESSION["EmpName"];	
			
			if($qty == ""){
				$qty = 0;
			}
			
			if($base == ""){
				$base = 0;
			}
			
			if($amount == ""){
				$amount = 0;
			}
					
			if($qty < 0){
				header("Location: ../overview.php?error=15");
				break;
			}	
			
			if($amount < 0){
				header("Location: ../overview.php?error=15");
				break;
			}	
			
			if($base < 0){
				header("Location: ../overview.php?error=15");
				break;
			}	
			
			if(($item_id == "") && ($qty == "")){
				header("Location: ../overview.php?error=6");
				break;
			}		
			
			if($item_id == "" || !is_numeric($qty) || !is_numeric($amount) || $item_code == "" || !is_numeric($base) || $desc == ""){
				header("Location: ../overview.php?error=7");
				break;
			}		
			
			//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----
			
			$checkItemID = mysql_query("SELECT item_name FROM item_table WHERE item_name = '$item_id'");
			
			if(mysql_num_rows($checkItemID) > 0) {
				header("Location: ../overview.php?error=9");
				break;
			}
			
			$checkItemID = mysql_query("SELECT item_code FROM item_table WHERE item_code = '$item_code'");
			
			if(mysql_num_rows($checkItemID) > 0) {
				header("Location: ../overview.php?error=12");
				break;
			}
			
			$query = mysql_query("CALL add_item ('$item_id', '$item_code', $qty, $amount, $base, '$desc');");
			$query = mysql_query("CALL item_log ('$item_id', '$user', 'Created', '$qty', '', null, null);");
			
			header("Location: ../overview.php?success=3");
		?>	
	</body>
	
	
	
	
	
	
	
	
	
</html>