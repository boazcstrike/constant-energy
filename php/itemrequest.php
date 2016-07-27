<html>
<head><title> Sending Request </title></head>
<body>
	<?php 
		session_start();
		
		//Connecting ---
		include("../../files/config.php");
		include("DbConnection.php");
		$dbconnect -> connect($DBuser, $DBpass, $DBurl);
		$dbconnect -> useDb($Database);
		//------

		$username = $_SESSION["UserName"];
		$employeename = $_SESSION["EmpName"];
		$item_name = $_POST["itemchosen"];
		$item_quantity = $_POST["quantity"];
		
		
		$query = mysql_query("SELECT item_code FROM item_table WHERE item_name LIKE '%{$item_name}%';");
		$query2 = mysql_query("SELECT quantity FROM item_table WHERE item_name LIKE '%{$item_name}%';");
		$result = mysql_fetch_array($query);
		$result2 = mysql_fetch_array($query2);
		$item_code = $result['item_code'];
		$available = $result2['quantity'];
		
		if($item_quantity < 0){
			header("Location: ../useroverview.php?error=15");
			}
		#else if($item_quantity = 0 || $item_quantity == null || $item_quantity == '' || !is_numeric($item_quantity)){
			#header("Location: ../useroverview.php?error=14");
			#}
		else{
		$sendrequest = mysql_query("CALL add_supplyorder ('$item_name','$item_code', '$employeename', '$item_quantity', 'Pending', '$available');");
			header("Location: ../useroverview.php?success=8");
		break;
			}
		
	?>
</body>
</html>