<?php
		session_start();
		//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
		//----

		$itemcode = $_POST["code"];
		

		$query = mysql_query("CALL decline_request ('$itemcode');");
		
		header("Location: ../pendingrequests.php");
		break;
	?>