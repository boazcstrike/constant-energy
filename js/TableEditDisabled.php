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
	

	
	if($result['action'] == "edit"){
		
	
		$query = mysql_query("UPDATE item_table SET item_name = '$itemname' where item_id = $id");
		$query = mysql_query("CALL update_item_table ( '$itemcode', '$itemname', $amount, '$description');");
		
	
	}else if($result['action']=="restore"){
	
	$query = mysql_query("UPDATE item_table SET status = 'active' where item_id = $id");
	

	}
	
	
?>	



