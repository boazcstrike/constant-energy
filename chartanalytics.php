<?php

		include("php/TableView.php");
		include("php/errors.php");
		include("php/success.php");
	        include("../files/config.php");
	        include("php/DbConnection.php");
	        $dbconnect -> connect($DBuser, $DBpass, $DBurl );
                $dbconnect -> useDb($Database);

		
		?>

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

		
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Item Name');
      data.addColumn('number', 'Quantity');
      <?php 
      	$c = 0;
      	$query= mysql_query("SELECT * FROM item_table ORDER BY quantity desc;");
      	while($result = mysql_fetch_array($query) and $c < 10){
      		$itemname = $result['item_name'];
      		$quantity = $result['quantity'];
      		$c++;
      		echo "data.addRow(['". $itemname ."',". $quantity ."]);";


      	}

      	?>

     
      
     

      // Set chart options
      var options = {'title':'Top 10 Items in Inventory',
                     'width':600,
                     'height':300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
    </script>

    	<title>StockEye</title>
		
		

		<title>StockEye</title>
		
	</head>
	<body>
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
	
		<div class="container-fluid" id="tools">
			<ul class="nav nav-tabs">
			<li role="presentation"><a href='monitoring-user.php'>Employee Logins</a></li>
			<li role="presentation"><a href='monitoring-item.php'>Item Monitoring</a></li>
			<li role="presentation"><a href='disableditems.php'>Disabled Items</a></li>
			<li role="presentation"><a href='requesthistory.php'>Request History</a></li>
			<li role="presentation"><a href='chartanalytics.php'>Inventory Charts</a></li>
			<li role="presentation"><a href='print.php'>Crystal Report</a></li>
			</ul>
			
			
			<center><div id="chart_div" style="width:600; height:300"></div>

			</div></center>
			

		
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


