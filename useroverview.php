<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="css/overview.css">
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
			if(isset($_GET["error"])){
				$errorHandler->getE($_GET["error"]);
			}
			
			if(isset($_GET["success"])){
				$successHandler->getSuccess($_GET["success"]);
			}
			
	?>

	
	<!--tool body-->

		<form action="useroverview.php" method="POST">
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

					<a href="useroverview.php">
					<button class="btn btn-success" id="refreshbtn" type="button" name="">Refresh &nbsp;<i class="fa fa-refresh"></i></button></a>
					<button class="btn btn-success" id="refreshbtn" type="button" name="request-btn" data-target="#request-item" data-toggle="modal">Request Item &nbsp;<i class="fa fa-comment"></i></button>
					
					<button class="btn btn-success" id="refreshbtn" type="button" name="request-btn" data-target="#myrequest" data-toggle="modal">My Requests &nbsp;<i class="fa fa-bars"></i></button>
			</div>
		</form>
		<!--searchbar-->
		<!--item table-->
		<div class="container-fluid" id="tools">
			
			<table class="table table-striped" id="itemtable">
			<tr>
				<th>Item ID</th>
				<th>Item Name</th>
				<th>Item Code</th>
				<th>Quantity</th>
				<th>Description</th>
			</tr>

			<?php
				
		               if(isset($_POST['searchedItem'])){
					$tableView -> getUserSearchedItem($_POST['searchedItem']);
				}else{
					$tableView -> getUserItemTable();
				}	
				
				?>

			</table>

		</div>
		<!--item table-->

<!--tool body-->

	


	<!--Request Item Modal-->
		<div class="modal fade" id="request-item" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Input Item Credentials</h4></strong>
					</div>

					<div class="modal-body">
						<div class="input-group panel panel-default">
						<form action="php/itemrequest.php" method="POST">
							
				
  							<select name="itemchosen">
  								<?php 
  									$query = mysql_query("SELECT * FROM item_table;");
									while($result = mysql_fetch_array($query)){
									echo '<option value="'. $result['item_name'] . '">'. $result['item_name'] .'</option>';
									}
								?>
							</select>

  							
  							<input type="text" class="form-control" name="quantity" placeholder="Quantity">
  							
  							<br><br>
  							
  							<span id="buttons"><button type="submit" class="btn btn-primary">Submit</button></span>

						</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Request Item Modal-->
		
		<!--My Requests Modal-->
		<div class="modal fade" id="myrequest" tab-index="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
						<strong><h4>Input Item Credentials</h4></strong>
					</div>

					<div class="modal-body" id="tools">
						<h1>My Requests</h1>
						<table class="table table-striped" id="itemtable">
						<th>Item Name</th>
						<th>Item Code</th>
						<th>Quantity</th>
						<th>Status</th>
						<th>Issuance No.</th>
						<?php
							$log_EmpName=$_SESSION['EmpName'];
                            				$connection = mysql_connect($DBurl,$DBuser,$DBpass);
		             				$database = mysql_query("use $Database");
							$query = mysql_query("SELECT * FROM supply_orders_table WHERE sender = '$log_EmpName' ORDER BY time DESC;");
							while($result = mysql_fetch_array($query)){
							$log_request_id = $result["request_id"];
							$log_item_name = $result["item_name"];
							$log_item_code = $result["item_code"];
							$log_quantity = $result["quantity"];
							$log_status = $result["status"];
							$log_reference = $result["reference"];

							echo "<tr>
									<td>$log_item_name</td>
									<td>$log_item_code</td>
                                    					<td>$log_quantity</td>
                                    					<td>$log_status</td>";
                                    					
                                    					if($log_status == "Accepted"){
                                    					echo "<td><form action='receiveorder.php' method='POST'>
                                    					<button class='btn btn-success btn-xs' type='submit'>Receive</button>
                                    					<input type='text' value='$log_request_id' name='requestid' style='display:none;'>
                                    					</form></td></tr>";}
                                    					else if($log_status == "Received"){
                                    					echo "<td>$log_reference</td></tr>";
                                    					}
                                    					else{
                                    					echo "</tr>";}
				}
				?>
					</div>
				</div>
			</div>
		</div>
		<!--My Requests Modal-->
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