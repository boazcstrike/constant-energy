<!Doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"> 
		<link rel="stylesheet" type="text/css" href="css/home.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		

		<title>StockEye</title>

		

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

		<div class="container-fluid" id="appgrid">
			<div class="row" id="line1">
				<a href="overview.php"><div class="col-md-6 item" id="overview"><span id="text">Overview</span> </div></a>
<!--
				<a href="manipulation.php"><div class="col-md-3 item" id="manipulation"><span id="text">Manipulation</span></div></a>
-->
				<a href="pendingrequests.php"><div class="col-md-6 item" id="requests"><span id="text">Pending Requests</span></div></a>

			</div>

			<div class="row" id="line2">
				<a href="monitoring.php"><div class="col-md-6 item" id="monitoring"><span id="text">Monitoring</span></div></a>

				<a href="admin-overview.php"><div class="col-md-6 item" id="admintools"><span id="text">Admin tools</span></div></a>
<!--
				<a href="itemreq.php"><div class="col-md-4 item" id="itemrequest"><span id="text">Item Request</span></div></a>
-->
			</div>

		</div>

		<div class="container-fluid" id="footer">


		</div>

			<script src="js/jquery-2.1.4.min.js"></script>

			<script src="js/bootstrap.min.js"></script>
	</body>