<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="css/overviewv2.css">
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
	$query_notif = mysql_query("SELECT * FROM supply_orders_table WHERE status = 'Pending'");

	$count = mysql_num_rows($query_notif);


	?>

	<!--navbar-->
		<div class="container-fluid" id="navbar">
		<center><ul class="nav nav-pills nav-justified">
			<a href='#'><li role="presentation" class="btn">Inventory Warehouse</li></a>
			<a href='pendingrequests.php'><li role="presentation" class="btn">Pending Requests <span class="badge"><?php echo "$count"; ?></span></li></a>
			<a href='monitoring.php'><li role="presentation" class="active btn btn-primary">Monitoring</li></a>
			<a href='admin-overview.php'><li role="presentation" class="btn">Admin Tools</li></a>
		</ul></center>

			
		</div>
	<!--navbar-->
		
		<div class="container-fluid">
			<ul class="nav nav-tabs">
			<li role="presentation"><a href='monitoring-user.php'>Employee Logins</a></li>
			<li role="presentation"><a href='monitoring-item.php'>Item Monitoring</a></li>
			<li role="presentation" class="active"><a href='disableditems.php'>Disabled Items</a></li>
			<li role="presentation"><a href='requesthistory.php'>Request History</a></li>
			<li role="presentation"><a href='chartanalytics.php'>Inventory Charts</a></li>
			<li role="presentation"><a href='print.php'>Crystal Report</a></li>
			</ul>

		</div>
	

	<!--tool body-->
	<form action="disableditems.php" method="POST">
		<!--searchbar-->
			<div class="container-fluid" id="searchbar">
				<div class="col-lg-4">
				<div class="input-group">
					<input type="text" name="searchedItem" class="form-control" placeholder="Search for item">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
						</span>
				</div>
				</div>
				<a href="disableditems.php">
					<button class="btn btn-success" id="refreshbtn" type="button" name=""><i class="fa fa-refresh"></i></button></a>
					</div>
				<div class="container-fluid" id="tools">
			
			<table class="table table-striped" id="itemtable">
			<tr>
				<th>Item ID</th>
				<th>Item Name</th>
				<th>Item Code</th>
				<th>Quantity</th>
				<th>Amount per unit (₱)</th>
				<th>Amount (₱)</th>
				<th>Description</th>
				
			</tr>

			<?php
				
		        if(isset($_POST['searchedItem'])){
					$tableView -> getDisabledSearchedItem($_POST['searchedItem']);
				}else{
					$tableView -> getDisabledItemTable();
				}
				
				
			?>

			</table>
			
				

		</div>

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
		<script src="js/jquery.tabledit.min.js"></script>
		<script src="js/jquery.tabledit.js"></script>
		<script src="js/Disabled.js"></script>
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
			