<?php
	
	//Connecting-----
	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
    $dbconnect -> useDb($Database);
	//Connecting-----
	
	
	$user=$_POST["uname"];
	
	if ($user == "" || $user == " " || $user == NULL ){
		header("Location: ../admin-overview.php?error=1");
		}else{
		
		$query = mysql_query("SELECT * FROM users_info_table WHERE username = '$user';");
		$result = mysql_fetch_array($query);
		
		if($result['status'] == "Active"){
			$query = mysql_query("	UPDATE users_info_table
												SET status = 'Disabled' 
												WHERE username = '$user'");
												header("Location: ../admin-overview.php?success=2");
												
			}else if($result['status'] == "Disabled"){
				header("Location: ../admin-overview.php?error=2");
				}else{
				header("Location: ../admin-overview.php?error=3");
				}
		}
?>