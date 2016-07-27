<?php
	
	class DbConnection{
	
		function connect($user, $pass, $url){
		
			$connection = mysql_connect($url,$user,$pass);
		
			if($connection==true){
				//echo "connected";
			}else{
				die("<b>Disconected</b> " . mysql_error());
			}
		
		}
		
		function useDb($database){
			$query = mysql_query("use $database;");
			if(!$query){
				die('No database' . mysql_error());
			}else{
				//echo("$database database selected<br>");
			}
		
		
		}
		
		function closeConnection(){
		
			$connection = mysql_close();
		
		}
		
	
	}
	
	$dbconnect = new DbConnection;
 
?>