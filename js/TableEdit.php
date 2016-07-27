<?php	
	                    
						session_start();
					
                                       if(!isset($_SESSION["EmpName"])){
                                       
                                       	 header("Location: ../index.php");
                                       	 die();
                                       }
						

	
	$result = filter_input_array(INPUT_POST);
	
		include("../../files/config.php");
	    include("../php/DbConnection.php");
	    $dbconnect -> connect($DBuser, $DBpass, $DBurl );
        $dbconnect -> useDb($Database);
		
	
		$id = $result['id'];
		$itemname = $result['item_name'];
		$itemcode = $result['item_code'];
		$amount = $result['amount'];
		$description = $result['desc'];
	
		if($amount <= 0){
			$query= mysql_query("Select * From item_table WHERE item_name='$itemname';");
			$queryresults= mysql_fetch_array($query);
			$amount=$queryresults['unit_price'];
		}
	
	if($result['action'] == "edit"){
		
	
		$query = mysql_query("UPDATE item_table SET item_name = '$itemname' where item_id = $id");
		$query = mysql_query("CALL update_item_table ( '$itemcode', '$itemname', $amount, '$description');");
		
	
	}else if($result['action']=="delete"){
	
	$query = mysql_query("UPDATE item_table SET status = 'disabled' where item_id = $id");
	

	}
	
	
?>	

