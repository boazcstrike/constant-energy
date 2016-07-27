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
			//Connecting---
			include("../files/config.php");
			include("php/DbConnection.php");
			$dbconnect -> connect($DBuser, $DBpass, $DBurl );
			$query = mysql_query("use $Database;");
			//----
			?>
		
	</head>
	<body>
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
			<li role="presentation" class="active"><a href='monitoring-item.php'>Item Monitoring</a></li>
			<li role="presentation"><a href='disableditems.php'>Disabled Items</a></li>
			<li role="presentation"><a href='requesthistory.php'>Request History</a></li>
			<li role="presentation"><a href='chartanalytics.php'>Inventory Charts</a></li>
			<li role="presentation"><a href='print.php'>Crystal Report</a></li>
			</ul>
		</div>
		<div class="container-fluid" id="tools">
			<table class="table table-striped" id="itemtable">
			<tr>
				<th>Item Name</th>
				<th>Latest Update</th>
				<th>Timestamp</th>
				<th>Action</th>
				<th>Value</th>
				<th>Previous</th>
				<th>Reference ID</th>
			</tr>
			<?php 
			
			
			$results = mysql_query("SELECT * FROM item_logs_table ORDER BY Timestamp DESC;");
			while ($row = mysql_fetch_array($results)) {
				
				$log_Time = new DateTime($row["Timestamp"]);
				$log_Date = date('Y-m-d H:i', $log_Time->format('U') + 50400);
				
				echo '<tr>';
				echo '<th>' . $row['Item_Name'] . '</th>';
				echo '<th>' . $row['User'] . '</th>';
				echo '<th>' . $log_Date . '</th>';
				echo '<th>' . $row['Action'] . '</th>';
				echo '<th>' . $row['Quantity'] . '</th>';
				echo '<th>' . $row['Previous'] . '</th>';
				
				if(($row['purchase_order'] == null) && ($row['issuance_no'] == true)){
					echo '<th> I.N.:' . $row['issuance_no'] . '</th>';
				}
				
				if(($row['issuance_no'] == null) && ($row['purchase_order'] == true)){
					echo '<th> P.O.:' . $row['purchase_order'] . '</th>';
				}
				
				echo '</tr>';
				}
			?>
			</table>
			
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


