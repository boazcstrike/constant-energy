<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="css/admin.css">
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
                    <?php    session_start();
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
			<a href='monitoring.php'><li role="presentation" class="btn">Monitoring</li></a>
			<a href='admin-overview.php'><li role="presentation" class="active btn btn-primary">Admin Tools</li></a>
		</ul></center>

			
		</div>
	<!--navbar-->

		<!--tool body-->
		
		

		<form action="admin-overview.php" method="POST">
		<!--searchbar-->
		<div class="container-fluid" id="searchbar">
			<div class="col-lg-4">
			<div class="input-group">
				<input type="text" name="searchedUser" class="form-control" placeholder="Search by username"/>
				<span class="input-group-btn">
					<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
					</span>
			</div>


			</div>

				<a href="admin-overview.php"><button class="btn btn-success" id="refreshbtn" type="button" name="">Refresh Table <i class="fa fa-refresh"></i></button></a>
				
		</div>
		</form>
		<!--searchbar-->

		<div class="container-fluid" id="toolstbl">
			<table class="table table-striped" id="accttable">
			<tr>
				<th>User ID</th>
				<th>Username</th>
				<th>Employee name</th>
				<th>Status</th>
				<th>Granted with Admin Rights</th>
			</tr>
			
			<?php
				if(isset($_POST['searchedUser'])){
					$tableView -> getSearchedAccounts($_POST['searchedUser']);
				}else{
					$tableView -> getAccountsTable();
				}
                                
				
				
			
			?>
			
			
			

			

			</table>


		</div>
		<!--tool body-->
		<button class="btn btn-danger" id="refreshbtn" type="button" data-toggle="modal" data-target="#dis-user">Disable Account <i class="fa fa-trash"></i></button>
		<button class="btn btn-success" id="refreshbtn" type="button" data-toggle="modal" data-target="#activate-user">Activate Account <i class="fa fa-fire"></i></button>
		<button class="btn btn-success" id="refreshbtn" type="button" data-toggle="modal" data-target="#add-user">Add Account <i class="fa fa-user-plus"></i></button>
		
		<?php 	
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}
			
			if(isset($_GET["success"])){
				$successHandler->getSuccess($_GET["success"]);
			}
			
		?>
		
		
		
		

		<!--Modals-->
		<div class="modal fade" id="add-user" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Add User<h4></strong>
					</div>

					<div class="modal-body">
						<div class="input-group panel panel-default">
						<form action="php/accounts.php" method="POST">
							
				
  							<input name="uname" type="text" class="form-control" placeholder="Username">
  							<input name="pass" type="password" class="form-control" placeholder="Password">
  							<input name="empname" type="text" class="form-control" placeholder="Employee name">
  							<br><br>
  							<label><input name="adminbox" type="checkbox" value="1"> Admin Rights</label>
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div>
					</div>
				</div>
			</div>
		</div>





		<div class="modal fade" id="dis-user" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Disable User</h4></strong>
					</div>

					<div class="modal-body">
						<center><div class="input-group panel panel-default">
						<form action="php/disable.php" method="POST">
							
				
  							<input type="text" name= "uname" class="form-control" placeholder="Username">
  				
  							<span id="buttons"><button type="submit" class="btn btn-primary">Disable</button></span>

						</form>
						</div></center>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="activate-user" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Activate User</h4></strong>
					</div>

					<div class="modal-body">
						<center><div class="input-group panel panel-default">
						<form action="php/activate.php" method="POST">
							
				
  							<input type="text" name="username" class="form-control" placeholder="Username">
  				
  							<span id="buttons"><button type="submit" class="btn btn-primary">Activate</button></span>

						</form>
						</div></center>
					</div>
				</div>
			</div>
		</div>


		<!--modals-->
		
		
		
		
		


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

