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
        	
		<?php 
                    include("../files/config.php");
                     $connection = mysql_connect($DBurl,$DBuser,$DBpass);
		             $database = mysql_query("use $Database");
                ?>
		<title>StockEye</title>
		
	</head>
	<body>
	<!--header-->
		<div class="container-fluid" id="header">
			<span style="float:right; font-size:15px; margin:2px; color:white;">
                Hi, <strong>
                    <?php 
						session_start();
						echo $_SESSION["EmpName"]; 
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
			<li role="presentation"><a href='disableditems.php'>Disabled Items</a></li>
			<li role="presentation" class="active"><a href='requesthistory.php'>Request History</a></li>
			<li role="presentation"><a href='chartanalytics.php'>Inventory Charts</a></li>
			<li role="presentation"><a href='print.php'>Crystal Report</a></li>
			</ul>

		</div>

	<!--tool body-->
		<div class="container-fluid" id="tools">
			
			<table class="table table-striped" id="itemtable">
			<tr>
				<th>Item Name</th>
				<th>Item Code</th>
				<th>Sender</th>
				<th>Quantity</th>
				<th>Time Requested</th>
				<th>Status</th>
				
			</tr>
			<?php 
                            
				$query = mysql_query("SELECT * FROM supply_orders_table WHERE status <> 'pending';");
				while($result = mysql_fetch_array($query)){
				$log_item_name = $result["item_name"];
				$log_item_code = $result["item_code"];
                $log_EmpName = $result["sender"];
				$log_quantity = $result["quantity"];
				$log_Time = new DateTime($result["time"]);
				$log_Date = date('Y-m-d H:i', $log_Time->format('U') + 50400);
				$log_status = $result["status"];

				echo "<tr>
						<td>$log_item_name</td>
						<td>$log_item_code</td>
						<td>$log_EmpName</td>
                        <td>$log_quantity</td>
                        <td>$log_Date</td>
                        <td>$log_status</td>
					  </tr>";
				}
				?>

			</table>

		</div>
		<!--tool body-->
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