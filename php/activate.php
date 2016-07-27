<?php

	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl  );
        $dbconnect -> useDb($Database);
	
	
	$username = $_POST["username"];
	
	if ($username == "" || $username == " " || $username == NULL ){
		header("Location:  ../admin-overview.php?error=1");
		}else{

			$query = mysql_query("SELECT * FROM users_info_table WHERE username = '$username';");
		
			$result = mysql_fetch_array($query);
		
			if($result['status'] == "Disabled"){
				$query = mysql_query("	UPDATE users_info_table
												SET status = 'Active' 
												WHERE username = '$username'");
												header("Location:  ../admin-overview.php?success=7");
												
			}else if($result['status'] == "Active"){
				header("Location:  ../admin-overview.php?error=11");
				}else{
				header("Location:  ../admin-overview.php?error=3");
				}
		}
?>