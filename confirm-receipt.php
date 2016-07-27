<?php
	include("php/TableView.php");
	include("php/errors.php");
	include("php/success.php");
	include("../files/config.php");
	include("php/DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
    $dbconnect -> useDb($Database);

    

    $request_id_num = $_POST['requestid'];
    $reference = $_POST['reference_num'];



    if($reference != "" && $reference != null){
    	$query = mysql_query("SELECT * FROM item_logs_table WHERE issuance_no = '$reference'");
    	if(mysql_num_rows($query)!=0){
   		$query2 = mysql_query("UPDATE supply_orders_table SET reference = '$reference' WHERE request_id = '$request_id_num'");
   		$query3 = mysql_query("UPDATE supply_orders_table SET status = 'Received' WHERE request_id = '$request_id_num'");
   		header("Location: useroverview.php?success=9");
   		
   		   }
   		else{
   		header("Location: useroverview.php?error=16");
   		}
   	}
   	else{
   		header("Location: useroverview.php?error=6");
   	}
   	?>