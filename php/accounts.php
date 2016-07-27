<?php

	include("../../files/config.php");
	include("DbConnection.php");
	$dbconnect -> connect($DBuser, $DBpass, $DBurl );
    $dbconnect -> useDb($Database);
	
	
	$username=$_POST["uname"];
	$password=$_POST["pass"];
	$empname=$_POST["empname"];
	$isadmin=$_POST["adminbox"];
	
	
	if ($username == "" || $username == " " || $username == NULL ||
		$password == "" || $password == " " || $password == NULL ||
		$empname == "" || $empname == " " || $empname == NULL
		){
			header("Location: ../admin-overview.php?error=4");
	}else{
		
	
		$query = mysql_query("SELECT * FROM users_table WHERE username = '$username';");
		$results = mysql_fetch_array($query);
	
		if($results['username']==$username){
			header("Location: ../admin-overview.php?error=5");
		}else{
		
		
		$query = mysql_query("CALL add_user('$username','$password')");
			if($isadmin == 1){
				$query = mysql_query("CALL add_user_info('$empname','Active','$username',1)");
			}else{
				$query = mysql_query("CALL add_user_info('$empname','Active','$username',0)");
			}
		header("Location: ../admin-overview.php?success=1");
			}
		}
?>