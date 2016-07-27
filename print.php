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

    <style>
      td{
        padding:10px;
      }

      tr{
        border:solid black 1px;
      }

      table{
        width:400px;
        border:solid black 2px;
        padding:10px;

      }
		</style>


	</head>
  <body>
    <div style="background-color:white; box-shadow:2px 2px 2px; height:50px; vertical-align:center;">
    <center><h1>Crystal Report <?php echo date('M Y'); ?></h1></center>
    </div>

    <center><div id="chart_div" style="width:600; height:300; margin-bottom:20px;"></div>

    </div></center>

    <center><div style="width:600px; height:300px; background-color:white; box-shadow:2px 2px 2px; padding:20px;">

    <?php
      $query = mysql_query("SELECT * FROM supply_orders_table WHERE extract(month from time)= MONTH(NOW()) AND extract(year from time) = YEAR(NOW());");

      $count_orders = mysql_num_rows($query);

      $query_deposit = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deposited' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");
      
      $count_deposits = mysql_num_rows($query_deposit);

      $query_withdraw = mysql_query("SELECT * FROM item_logs_table WHERE Action = 'Deducted' AND extract(month from Timestamp)= MONTH(NOW()) AND extract(year from Timestamp) = YEAR(NOW());");
      
      $count_withdraw = mysql_num_rows($query_withdraw);
      ?>
      <table>
        <thead>
          <th>Information</th>
          <th>Value</th>
        </thead>
        <tbody>
          <tr>
            <td>Number of Item Requests for the Month</td>
            <td><?php echo "$count_orders"; ?></td>
          </tr>
          <tr>
            <td>Number of Item Deposits for the Month</td>
            <td><?php echo "$count_deposits"; ?></td>
          </tr>
          <tr>
            <td>Number of Item Withdrawals for the Month</td>
            <td><?php echo "$count_withdraw"; ?></td>
          </tr>
        </tbody>
      </table>

        <center><button class="btn btn-primary" onclick="window.print()">Print</button> <a href="monitoring.php" class="btn btn-default">Return</a></center>


    </div></center>










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