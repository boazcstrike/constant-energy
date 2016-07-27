<html>
<head><title>Logging in</title></head>
<body>
	<?php
		session_start();
		
		$username= $_POST["username"];
		$password= $_POST["password"];
		
		if($username == null || $password == null){
			header("Location: ../index.php?error=1");
		}else{
		
			//Connecting---
			include("../../files/config.php");
			include("DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$dbconnect -> useDb($Database);
			//----
			
			
			$check = mysql_query("SELECT * FROM users_table WHERE username = '$username';");   
			
			if(mysql_num_rows($check)!=0){
			while($results = mysql_fetch_array($check)){
			
			
				if($results['password']==$password&&$results['username']==$username){
				
                   
					$query = mysql_query("SELECT * FROM users_info_table WHERE username='$username';");
					$result = mysql_fetch_array($query);
                                        $empName = $result['employee_name'];
		 
					if($result['status']=="Active"){
					
						$_SESSION["UserName"] = $username;
						$_SESSION["EmpName"] = $result['employee_name'];
						$_SESSION["admin"] = $result['admin'];
                                                $insertlog = mysql_query("CALL Login_log ('$username','$empName');");
						$dbconnect -> closeConnection();
						if($result['admin'] == 1){
							header("Location: ../overview.php");
							}
						else{
							header("Location: ../useroverview.php");
							}
						break;
					}else{
						header("Location: ../index.php?error=2");
					}
				}else{
					header("Location: ../index.php?error=1");
				}
			
			}
			}else{
				header("Location: ../index.php?error=1");
			}
		}
		
		
		
		
		
	?>
</body>
</html>