<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="css/login.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<!--Material design-->
		<link href="css/roboto.min.css" rel="stylesheet">
        	<link href="css/material.min.css" rel="stylesheet">
        	<link href="css/ripples.min.css" rel="stylesheet">
		

		<title>StockEye</title>
		
	</head>
	<body>
		<div class="container-fluid" id="header">


		</div>

		<div class="container-fluid" id="formcontainer">

			
			<form action="php/authentication.php" method="POST">
			<center><span><img id="logo" src="css/img/logo.png"></span></center>
			<center><h3><span class="headertxt">Constant Energy Source</span></h3></center>

			
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Username</span>
				<input type="text" name="username" class="form-control" placeholder="Type your username">



				</div>
			<div class="input-group">
				<span class="input-group-addon" id="basic-addon1">Password</span>
				<input type="password" name="password" class="form-control" placeholder="Type your password">
				</div><br>
			<div class="input-group">
				<input type="submit" class="btn btn-success" value="Log in">
				</div>
			<?php 
			session_start();
                            if(isset($_SESSION["EmpName"])){
                                 if($_SESSION["admin"] == 0){
                                 	header("Location: useroverview.php");
                                 	}
                                 else{
                                 	header("Location: home.php");
                                 
                                 }
                             }
			

			if (isset($_GET['error'])){
                 if($_GET['error']==1){
					echo "<br><br><br><div class='alert alert-danger' role='alert'><strong>Try Again. </strong> Username or Password incorrect.</div>";
				 }else if($_GET['error']==2){
					echo "<br><br><br><div class='alert alert-danger' role='alert'><strong>Oh no. </strong> This Acount has been disabled.</div>";
				 }
				
			} 
				 ?>

				
			</div>
		</div>
		</form>
		<div class="container-fluid" id="footer">
		
		<p style="color:white">Inventory Management System powered by StockEye</p>



		</div>
		
			
				


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