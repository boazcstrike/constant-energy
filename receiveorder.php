<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> 
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="css/receive.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<!--Material design-->
		<link href="css/roboto.min.css" rel="stylesheet">
        	<link href="css/material.min.css" rel="stylesheet">
        	<link href="css/ripples.min.css" rel="stylesheet">
		

		<title>StockEye</title>
		<?php

		include("php/TableView.php");
		include("php/errors.php");
		include("php/success.php");
	        include("../files/config.php");
	        include("php/DbConnection.php");
	        $dbconnect -> connect($DBuser, $DBpass, $DBurl );
                $dbconnect -> useDb($Database);

		
		?>
		
	</head>
	<body>
	<!--header-->
		<div class="container-fluid" id="header">
			<span style="float:right; font-size:15px; margin:2px; color:white;">
                Hi, <strong>
                    <?php 
						session_start();
                                       if(!isset($_SESSION["EmpName"])){
                                       
                                       	 header("Location: index.php");
                                       	 die();
                                       }else{
						
						echo $_SESSION["EmpName"]; 
					}
						?> 
                   </strong>
                     <a href="logout.php"><input class="btn btn-primary" type="button" value="Logout"></a>
                </span>
		</div>
	<!--header-->
	<?php 
		$log_requestid = $_POST["requestid"];
		?>

	<center><div class="panel panel-success" id="main-panel">
   	 	<div class="panel-heading">
        	<h3 class="panel-title"><?php echo "Receive order for Request: $log_requestid";?></h3>
    	</div>
    	<div class="panel-body">
       		<form action="confirm-receipt.php" method="POST">
       			<fieldset>
       				<div class="form-group">
       					<input type="text" class="form-control" name="reference_num" placeholder="Issuance number">
       				<?php
       					echo "<input type='text' value='$log_requestid' name='requestid' style='display:none;'>";
       					?>
       				</div>
       				<div class="form-group">
       					<a href="useroverview.php" class="btn btn-default">Return</a>
       					<button type="submit" class="btn btn-primary">Submit</button>
       				</div>
       				<div class="form-group">
       					<p>Please enter the issuance number that can be found on the issuance slip <br>provided with the delivery</p>
       				</div>
       			</fieldset>
       		</form>
   		</div>
	</div></center>
	
		



<!--tool body-->

	<?php 	
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}
			
			if(isset($_GET["success"])){
				$successHandler->getSuccess($_GET["success"]);
			}
			
	?>
		
		
		<script src="js/jquery-2.1.4.min.js"></script>

		<script src="js/bootstrap.min.js"></script>
		
		<!---Material script-->
			<script src="js/ripples.min.js"></script>
       	   	 <script src="js/material.min.js"></script>
           	 <script>
           	 $(document).ready(function() {
                // This command is used to initialize some elements and make them work properly
                $.material.init();
           	 });
        	</script>
        	<!---->

	
	
</body>
</html>