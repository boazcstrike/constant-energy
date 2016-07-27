<?php
	
		


	class TableViews{
			
		
		
		function getTotalAmount(){
				$query = mysql_query("SELECT * FROM item_table;");
				$netamount = 0;
				while($result = mysql_fetch_array($query)){

					if($result['status']=="active"){
						$quantity = $result['quantity'];
						$unitprice = $result['unit_price'];
						$totalprice = $unitprice * $quantity;
						$netamount += $totalprice;
					}
				}
				echo number_format($netamount,2);
		}
		
		
		function getAccountsTable(){
		
			

			$query = mysql_query("SELECT * FROM users_info_table;");
			$index = 0;
			while($result = mysql_fetch_array($query)){
				$index= $index+1;
				$u = $result['username'];
				$en = $result['employee_name'];
				$s = $result['status'];
				$a = $result['admin'];
					
				if($a == 1){
					$a="Yes";
				}else if($a == 0){
					$a="No";
				}
					
					echo"<tr>
						<td contenteditable='true' >$index</td>
						<td contenteditable='true'>$u</td>
						<td contenteditable='true'>$en</td>
						<td contenteditable='true'>$s</td>
						<td contenteditable='true'>$a</td>
						</tr>";					
				}
			
			
		}
		
		function getSearchedAccounts($searchedUser){
		
			if($searchedUser!= null && $searchedUser != "" && $searchedUser && " "){
			
				$query = mysql_query("SELECT * FROM users_info_table where username= '$searchedUser';");
				$index = 0;
				
				if (mysql_num_rows($query) == 0) {
				
					echo"<center><tr><td>Searched returned nothing. Refresh table to view all accounts</td></tr></center>";					
				
				}else{
					while($result = mysql_fetch_array($query)){
						$index= $index+1;
						$u = $result['username'];
						$en = $result['employee_name'];
						$s = $result['status'];
						$a = $result['admin'];
					
						if($a == 1){
							$a="Yes";
						}else if($a == 0){
							$a="No";
						}
					
							echo"<tr>
								<td contenteditable='true' >$index</td>
								<td contenteditable='true'>$u</td>
								<td contenteditable='true'>$en</td>
								<td contenteditable='true'>$s</td>
								<td contenteditable='true'>$a</td>
								</tr>";					
						}
					}
			}else{
				echo"Searched returned nothing. Refresh table to view all accounts";					
			}

		}


		function getItemTable(){
		
			
				$query = mysql_query("SELECT * FROM item_table;");
				while($result = mysql_fetch_array($query)){			
					
				
					if($result['status']=="active"){
						$itemid = $result['item_id'];
						$itemcode= $result['item_code'];
						$itemname = $result['item_name'];
						$quantity = $result['quantity'];
						$bQuantity = $result['baseline_quantity'];
						$unitprice = $result['unit_price'];
						$totalprice = $unitprice * $quantity;
						$description = $result['description'];
					
							echo '<tr>';
							echo '<td>' . $itemid . '</td>';
							echo '<td>' . $itemname . '</td>';
							echo '<td>' . $itemcode . '</td>';
							if($quantity<=$bQuantity){
								echo '<td style="color:red">' . $quantity . '</td>';
							}else{
								echo '<td>' . $quantity . '</td>';
							}
							echo '<td>' . number_format($unitprice,2) . '</td>';
							echo '<td>' . number_format($totalprice,2) . '</td>';
							echo '<td>' . $description . '</td>';
	             	
							echo '</tr>';
					}
				}
		}

       		 function getSearchedItem($searchedItem){
           		 if($searchedItem!= null && $searchedItem != "" && $searchedItem && " "){
			
				$query = mysql_query("SELECT * FROM item_table WHERE item_name LIKE '%{$searchedItem}%';");
			
				
				if (mysql_num_rows($query) == 0) {
				
					echo"Searched returned nothing. Refresh table to view all accounts";					
				
				}else{
					while($result = mysql_fetch_array($query)){
						if($result['status']=="active"){
							$itemid = $result['item_id'];
							$itemcode= $result['item_code'];
							$itemname = $result['item_name'];
							$quantity = $result['quantity'];
							$bQuantity = $result['baseline_quantity'];
							$unitprice = $result['unit_price'];
							$totalprice = $unitprice * $quantity;
							$description = $result['description'];
							echo '<tr>';
								echo '<td>' . $itemid . '</td>';
								echo '<td>' . $itemname . '</td>';
								echo '<td>' . $itemcode . '</td>';
								if($quantity<=$bQuantity){
									echo '<td style="color:red">' . $quantity . '</td>';
								}else{
									echo '<td>' . $quantity . '</td>';
								}
								echo '<td>' . number_format($unitprice,2) . '</td>';
								echo '<td>' . number_format($totalprice,2) . '</td>';
								echo '<td>' . $description . '</td>';
							echo '</tr>';				
						}
					}
				}
				
			}else{
					echo"Searched returned nothing. Refresh table to view all accounts";					
			}	
        	}
			
			
			
        	
        	function getUserItemTable(){
		
			
				$query = mysql_query("SELECT * FROM item_table;");
				while($result = mysql_fetch_array($query)){						
					if($result['status']=="active"){
						$itemid = $result['item_id'];
						$itemcode= $result['item_code'];
						$itemname = $result['item_name'];
						$quantity = $result['quantity'];
						$bQuantity = $result['baseline_quantity'];
						$description = $result['description'];
						echo '<tr>';
						echo '<td>' . $itemid . '</td>';
						echo '<td>' . $itemname . '</td>';
						echo '<td>' . $itemcode . '</td>';
						if($quantity<=$bQuantity){
							echo '<td style="color:red">' . $quantity . '</td>';
						}else{
							echo '<td>' . $quantity . '</td>';
						}
						echo '<td>' . $description . '</td>';
	             	
						echo '</tr>';
					}
					
					
				}
		}

       		 function getUserSearchedItem($searchedItem){
           		 if($searchedItem!= null && $searchedItem != "" && $searchedItem && " "){
			
				$query = mysql_query("SELECT * FROM item_table WHERE item_name LIKE '%{$searchedItem}%';");
			
				
				if (mysql_num_rows($query) == 0) {
				
					echo"Searched returned nothing. Refresh table to view all accounts";					
				
				}else{
					while($result = mysql_fetch_array($query)){
					if($result['status']=="active"){
							$itemid = $result['item_id'];
							$itemcode= $result['item_code'];
							$itemname = $result['item_name'];
							$quantity = $result['quantity'];
							$bQuantity = $result['baseline_quantity'];
							$description = $result['description'];
							echo '<tr>';
								echo '<td>' . $itemid . '</td>';
								echo '<td>' . $itemname . '</td>';
								echo '<td>' . $itemcode . '</td>';
								if($quantity<=$bQuantity){
									echo '<td style="color:red">' . $quantity . '</td>';
								}else{
									echo '<td>' . $quantity . '</td>';
								}
								echo '<td>' . $description . '</td>';
							echo '</tr>';	
						}
					}
				}
				
			}else{
					echo"Searched returned nothing. Refresh table to view all accounts";					
			}	
        	}
        	
        	function getDisabledItemTable(){
		
			
				$query = mysql_query("SELECT * FROM item_table;");
				while($result = mysql_fetch_array($query)){			
					
				
					if($result['status']=="disabled"){
						$itemid = $result['item_id'];
						$itemcode= $result['item_code'];
						$itemname = $result['item_name'];
						$quantity = $result['quantity'];
						$bQuantity = $result['baseline_quantity'];
						$unitprice = $result['unit_price'];
						$totalprice = $unitprice * $quantity;
						$description = $result['description'];
					
							echo '<tr>';
							echo '<td>' . $itemid . '</td>';
							echo '<td>' . $itemname . '</td>';
							echo '<td>' . $itemcode . '</td>';
							if($quantity<=$bQuantity){
								echo '<td style="color:red">' . $quantity . '</td>';
							}else{
								echo '<td>' . $quantity . '</td>';
							}
							echo '<td>' . number_format($unitprice,2) . '</td>';
							echo '<td>' . number_format($totalprice,2) . '</td>';
							echo '<td>' . $description . '</td>';
	             	
							echo '</tr>';
					}
				}
		}
		
		function getDisabledSearchedItem($searchedItem){
           		 if($searchedItem!= null && $searchedItem != "" && $searchedItem && " "){
			
				$query = mysql_query("SELECT * FROM item_table WHERE item_name LIKE '%{$searchedItem}%' AND status='disabled';");
			
				
				if (mysql_num_rows($query) == 0) {
				
					echo"Searched returned nothing. Refresh table to view all accounts";					
				
				}else{
					while($result = mysql_fetch_array($query)){
						if($result['status']=="disabled"){
							$itemid = $result['item_id'];
							$itemcode= $result['item_code'];
							$itemname = $result['item_name'];
							$quantity = $result['quantity'];
							$bQuantity = $result['baseline_quantity'];
							$unitprice = $result['unit_price'];
							$totalprice = $unitprice * $quantity;
							$description = $result['description'];
							echo '<tr>';
								echo '<td>' . $itemid . '</td>';
								echo '<td>' . $itemname . '</td>';
								echo '<td>' . $itemcode . '</td>';
								if($quantity<=$bQuantity){
									echo '<td style="color:red">' . $quantity . '</td>';
								}else{
									echo '<td>' . $quantity . '</td>';
								}
								echo '<td>' . number_format($unitprice,2) . '</td>';
								echo '<td>' . number_format($totalprice,2) . '</td>';
								echo '<td>' . $description . '</td>';
							echo '</tr>';				
						}
					}
				}
				
			}else{
					echo"Searched returned nothing. Refresh table to view all accounts";					
			}	
        	}
			
        	
		
		
		
	}
	
	$tableView = new TableViews;
 
?>