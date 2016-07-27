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
			<a href='#'><li role="presentation" class="active btn btn-primary">Inventory Warehouse</li></a>
			<a href='pendingrequests.php'><li role="presentation" class="btn">Pending Requests <span class="badge"><?php echo "$count"; ?></span></li></a>
			<a href='monitoring.php'><li role="presentation" class="btn">Monitoring</li></a>
			<a href='admin-overview.php'><li role="presentation" class="btn">Admin Tools</li></a>
		</ul></center>

			
		</div>
	<!--navbar-->

	<!--tool body-->
	<form action="overview.php" method="POST">
	<div class="navbar">
		<!--searchbar-->
			<div class="container-fluid" id="searchbar">
				
				<div class="navbar-collapse collapse navbar-primary-collapse">
					<ul class="nav navbar-nav">
					<li><a href="overview.php">
					Refresh <i class="fa fa-refresh fa-spin"></i></a></li>
					
					<li><a href="php/print.php">Print <i class="fa fa-print"></i></a></li>

					<li><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add-item">Add New Item &nbsp; <i class="fa fa-plus"></i></button></li>

					<li><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#update-baseline">Update Baseline &nbsp; <i class="fa fa-arrows-v"></i></button></li>

					<li><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#increase-item">Deposit Item &nbsp; <i class="fa fa-plus"></i></button></li>

					<li><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#withdraw-item">Withdraw Item &nbsp; <i class="fa fa-minus"></i></button></li>

					<li><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#update-item">Update Item &nbsp; <i class="fa fa-cog fa-spin"></i></button></li>
					</ul>
					
					<div class="col-md-4">
				<div class="input-group" style="margin-bottom:10px;">
					<input type="text" name="searchedItem" class="form-control floating-label" placeholder="Search for item" style="color:white";>
					<span class="input-group-btn">
						<button class="btn btn-default btn-xs" type="submit"><i class="fa fa-search" style="color:white;"></i></button>
						</span>
				</div>


				</div>
				<h5><strong>Total Amount :<br>₱</strong> <?php $tableView -> getTotalAmount();?>	</h5>
			</div>
		</div>
	</div>
		</form>
		
		<?php 	
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}
			
			if(isset($_GET["success"])){
				$successHandler->getSuccess($_GET["success"]);
			}
			
	?>

		
			<div class="container-fluid" id="tools">
			<table class="table table-striped" id="itemtable">
			<thead id="stickyHeader">
				<tr>
				<th>Item ID</th>
				<th>Item Name</th>
				<th>Item Code</th>
				<th>Quantity</th>
				<th>Amount per unit (₱)</th>
				<th>Amount (₱)</th>
				<th>Description</th>
				</tr>
			</thead>
			
			
			<tbody>
			<?php
				
		        if(isset($_POST['searchedItem'])){
					$tableView -> getSearchedItem($_POST['searchedItem']);
				}else{
					$tableView -> getItemTable();
				}
				
				
			?>
			</tbody>
			</table>
			</div>
			
				

		
		
	
	
		
		
		 
		
		<!--New item Modal-->
		<div class="modal fade" id="add-item" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Input Item Credentials</h4></strong>
					</div>

					<div class="modal-body">
						<div class="input-group">
						<form action="php/new.php" method="POST">
							
				
  							<input type="text" class="form-control" name = "item" placeholder="Item Name">
							<input type="text" class="form-control" name = "code" placeholder="Item Code">
  							<input type="text" class="form-control" name = "qty" placeholder="Current at hand">
							<input type="text" class="form-control" name = "amount" placeholder="Amount Per Unit">
  							<input type="text" class="form-control" name = "base" placeholder="Baseline Quantity">
							<input type="text" class="form-control" name = "description" placeholder="Brief Description">
  							<br><br>
  							
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--New item Modal-->

		<!--remove item Modal-->
		<div class="modal fade" id="update-baseline" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Input New Baseline</h4></strong>
					</div>

					<div class="modal-body">
						<center><div class="input-group">
						<form action="php/update_base.php" method="POST">
							
				
  							<select name="item">
  								<option value='' disabled selected>Choose Item</option>
  								<?php 
  									$query = mysql_query("SELECT * FROM item_table;");
									while($result = mysql_fetch_array($query)){
									echo '<option value="'. $result['item_name'] . '">'. $result['item_name'] .'</option>';
									}
								?>
							</select>
							<input type="text" class="form-control" name = "base" placeholder="New Baseline Quantity">
  							
  							<br><br>
  							
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div></center>
					</div>
				</div>
			</div>
		</div>
		<!--remove item Modal-->

		<!--increase Item Modal-->
		<div class="modal fade" id="increase-item" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Input Item Credentials for Reciept</h4></strong>
					</div>

					<div class="modal-body">
						<center><div class="input-group">
						<form action="php/increase-item.php" method="post">
							
				
  							<select name="itemchosen">
  								<option value='' disabled selected>Choose Item</option>
  								<?php 
  									$query = mysql_query("SELECT * FROM item_table WHERE status = 'active';");
									while($result = mysql_fetch_array($query)){
									echo '<option value="'. $result['item_name'] . '">'. $result['item_name'] .'</option>';
									}
								?>
							</select>

  							
  							<input type="text" class="form-control" name="quantity" placeholder="Quantity">						
  							<input type="text" class="form-control" name="reference" placeholder="Purchase Order No.">
							
  							<br><br>
  							
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div></center>
					</div>
				</div>
			</div>
		</div>
		<!--Increase Item Modal-->

		<!--increase Item Modal-->
		<div class="modal fade" id="withdraw-item" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Input Item Credentials for Withdrawal</h4></strong>
					</div>

					<div class="modal-body">
						<center><div class="input-group">
						<form action="php/decrease-item.php" method="post">
							
				
  							<select name="itemchosen">
  								<option value='' disabled selected>Choose Item</option>
  								<?php 
  									$query = mysql_query("SELECT * FROM item_table WHERE status = 'active';");
									while($result = mysql_fetch_array($query)){
									echo '<option value="'. $result['item_name'] . '">'. $result['item_name'] .'</option>';
									}
								?>
							</select>
							
  							
  							<input type="text" class="form-control" name="quantity" placeholder="Quantity">
							<input type="text" class="form-control" name="reference" placeholder="Invoice No.">
  							
  							<br><br>
  							
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div></center>
					</div>
				</div>
			</div>
		</div>
		<!--Increase Item Modal-->

		<!--New item Modal-->
		<div class="modal fade" id="update-item" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Update Item Credentials</h4></strong>
						<p>If some attributes are left blank, they will be not updated.</p>
					</div>

					<div class="modal-body">
						<div class="input-group panel panel-default">
						<form action="php/update.php" method="POST">
							
				
  							<select name="item">
  								<option value='' disabled selected>Choose Item</option>
  								<?php 
  									$query = mysql_query("SELECT * FROM item_table WHERE status='active';");
									while($result = mysql_fetch_array($query)){
									echo '<option value="'. $result['item_name'] . '">'. $result['item_name'] .'</option>';
									}
								?>
							</select>
							<input type="text" class="form-control" name = "new_item" placeholder="Update Item Name">
							<input type="text" class="form-control" name = "code" placeholder="Update Item Code">
							<input type="text" class="form-control" name = "amount" placeholder="Update Amount Per Unit">
							<input type="text" class="form-control" name = "description" placeholder="Update Brief Description">
  							<br><br>
  							
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
			
		<!--tool body-->
		
	

		<script src="js/jquery-2.1.4.min.js"></script>
		<script src="js/jquery.tabledit.min.js"></script>
		<script src="js/jquery.tabledit.js"></script>
		<script src="js/edit.js"></script>
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