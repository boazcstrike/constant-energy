<?php
	//Connecting---
			include("../files/config.php");
			include("php/DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----

			$query = mysql_query("SELECT * FROM supply_orders_table WHERE extract(month from time)= MONTH(NOW()) AND extract(year from time) = YEAR(NOW());");

			while($result = mysql_fetch_array($query)){
				$request_id = $result['request_id'];
				$sender = $result['sender'];

				echo "<p>$sender asdasd</p>";
			}

			$query_deposit = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deposited' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");
			while($result2 = mysql_fetch_array($query_deposit)){
				$item_name = $result2['Item_name'];
				$user = $result2['User'];

				echo "<p>$item_name $user asdasd</p>";
			}

			$query_withdraw = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deducted' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");
			while($result3 = mysql_fetch_array($query_withdraw)){
				$item_name = $result3['Item_name'];
				$user = $result3['User'];

				echo "<p>$item_name $user asdasd</p>";
			}

			?>