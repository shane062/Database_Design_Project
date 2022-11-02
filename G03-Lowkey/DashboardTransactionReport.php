<?php
	include "dbConnection_arngren.php";
?>

<!DOCTYPE HTML>
<html lang = "en">

  <!---G03-Lowkey Mockup code for main page--->
  <!---1. Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->
  <!---2. Harith Zakwan Bin Zakaria (73484)------------------->
  <!---3. Iman Tarmizi Rosalina (73496)----------------------->
  <!---4. Lai Weng Hong (75351)------------------------------->

<head>
	<meta charset = "UTF-8">
	<title>Arngren | Home</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: Helvetica;
		}
		
		body {
			overflow-x: hidden;
		}
		
		.sidebarcontainer {
			position: relative;
			width: 100%;
		}
		
		.sidebar {
			position: fixed;
			width: 325px;
			height: 100%;
			background: #c45b56;
			transition: 0.5s;
			overflow: hidden;
		}
		
		.sidebar a.active {
			background:  #ecd846;
			color: #ecd846;
		}
		
		.sidebar ul li a.active .icon .fa {
			color: #c45b56;
			font-size: 24px;
		}
		
		.sidebar ul li a.active .title {
			position: relative;
			display: block;
			padding: 0 10px;
			height: 60px;
			line-height: 60px;
			color: #c45b56;
			white-space: nowrap;
		}
		
		
		.sidebar ul {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
		}
		
		.sidebar ul li {
			position: relative;
			width: 100%;
			list-style: none;
		}

		
		.sidebar ul li:hover {
			background: #7a3835;
		}
		
		.sidebar ul li:nth-child(1) {
			margin-bottom: 10px;
		}
		
		.sidebar ul li:nth-child(1):hover {
			background: transparent;
		}
		
		.sidebar ul li a {
			position: relative;
			display: block;
			width: 100%;
			display: flex;
			text-decoration: none;
		}
		
		.sidebar ul li a .icon { 
			position: relative;
			display: block;
			min-width: 60px;
			height: 60px;
			line-height: 60px;
			text-align: center;
		}
		
		.sidebar ul li a .icon .fa {
			color: #ecd846;
			font-size: 24px;
		}
		
		.sidebar ul li a .title {
			position: relative;
			display: block;
			padding: 0 10px;
			height: 60px;
			line-height: 60px;
			color: #ecd846;
			white-space: nowrap;
		}
		
		.main {
			position: absolute;
			width: calc(100% - 325px);
			left: 325px;
			min-height: 100vh;
			background: lightgrey;
		}
		
		.main .topbar {
			width: 100%;
			background: white;
			height: 60px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 20px;
		}
		
		.main .topbar i {
			font-size: 25px;
		}
		
		.main .topbar small {
			visibility: visible;
			padding: 10px;
		}
		
		<!--Main Content-->
		body {
            font-family: 'Open sans', sans-serif;
             background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
            background-repeat: no-repeat;
            background-attachment: fixed;  
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0px;
             font-size: 17px;
            padding: 8px;
        }

        .container {
            padding: 16px;
            background-color: lightgrey;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            width: 1000px;
            max-width: 100%;
            height: 550px;
        }

        .dropdailybtn{
            background-color: #c45b56;
            color: #ecd846;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdowndaily{
            position: relative;
            display: inline-block;
            align-items: left;
        }

        .dropdowndaily-content{
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdowndaily-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdownweekly-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdowndaily-content a:hover  {
        	background-color: #f1f1f1
        }

        .dropdowndaily:hover .dropdowndaily-content {
            display: block;
        }

        .dropdowndaily:hover .dropdailybtn {
            background-color: #7a3835;
        }

        .dropweeklybtn {
            background-color: #c45b56;
            color: #ecd846;
            padding: 16px;
            font-size: 16px;
            border: none;
			cursor: pointer;
        }

        .dropdownweekly {
            position: relative;
            display: inline-block;
        }

        .dropdownweekly-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdownweekly-content a {
           color: black;
           padding: 12px 16px;
           text-decoration: none;
           display: block;
        }

        .dropdownweekly-content a:hover {background-color: #f1f1f1}

        .dropdownweekly:hover .dropdownweekly-content {
           display: block;
        }

        .dropdownweekly:hover .dropweeklybtn {
            background-color: #7a3835;
        }

        .dropmonthlybtn {
            background-color: #c45b56;
            color: #ecd846;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdownmonthly {
           position: relative;
           display: inline-block;
		}

        .dropdownmonthly-content {
           display: none;
           position: absolute;
           background-color: #f9f9f9;
           min-width: 160px;
           box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
           z-index: 1;
        }

        .dropdownmonthly-content a {
           color: black;
           padding: 12px 16px;
           text-decoration: none;
           display: block;
        }

        .dropdownmonthly-content a:hover {background-color: #f1f1f1}

        .dropdownmonthly:hover .dropdownmonthly-content {
           display: block;
        }

        .dropdownmonthly:hover .dropmonthlybtn {
           background-color: #7a3835;
        }

        .chart{
        	align-items: center;
        	object-position: center;
        }
	</style>
	
	<script src="https://use.fontawesome.com/59805f286a.js"></script>

	<!---favicon--->
	<link rel="icon" type="image/x-icon" href="arngrenlogo.PNG">
</head>

<body>
	<div class = "sidebarcontainer">
		<div class = "sidebar" id = "sidebar">
			<ul>
				<li>
					<a href = "">
						<span class = "icon"><img src = "arngrenlogo.PNG" width = "50px"></span>
						<span class = "title"><h2>www.ARNGREN.net</h2></span>
					</a>
				</li>
				<li>
					<a href = "DashboardAccounts.php">
						<span class = "icon"><i class = "fa fa-users"></i></span>
						<span class = "title">Accounts</span>
					</a>
				</li>
				<li>
					<a href = "DashboardProducts.php">
						<span class = "icon"><i class = "fa fa-shopping-cart"></i></span>
						<span class = "title">Products</span>
					</a>
				</li>
				<li>
					<a href = "DashboardTransactionRecord.php">
						<span class = "icon"><i class = "fa fa-bar-chart"></i></span>
						<span class = "title">Transaction Record</span>
					</a>
				</li>
				<li>
					<a class = "active" href = "DashboardTransactionReport.php">
						<span class = "icon"><i class = "fa fa-print"></i></span>
						<span class = "title">Transaction Report</span>
					</a>
				</li>
				<li>
					<a href = "logoutAdmin.php">
						<span class = "icon"><i class = "fa fa-sign-out"></i></span>
						<span class = "title">Log Out</span>
					</a>
				</li>
			</ul>
		</div>
		
		<div class = "main">
			<div class = "topbar">
				<div class = "admin">
					<i style = "color: #c45b56" class = "fa fa-user-circle"></i>
					<small>
						<?php
							global $conn;
							$sql = "SELECT adminUsername FROM admin WHERE logStatus = 1;";
							$result = mysqli_query($conn, $sql);
							
							if ($result -> num_rows > 0)
							{
								while ($row = $result -> fetch_assoc())
								{
									echo $row["adminUsername"];
								}
							}
						?>
					</small>
				</div>
			</div>
			<div class="container">
				<h2 style = "color: #c45b56;"><i class="fa fa-design"></i> Sales Report</h2>

				<div class="dropdowndaily">
					<button class="dropdailybtn">Daily</button>
					<div class="dropdowndaily-content">
						<a href="#">Monday</a>
						<a href="#">Tuesday</a>
						<a href="#">Wednesday</a>
						<a href="#">Thursday</a>
						<a href="#">Friday</a>
						<a href="#">Saturday</a>
						<a href="#">Sunday</a>
					</div>
				</div>

				<div class="dropdownweekly">
					<button class="dropweeklybtn">Weekly</button>
					<div class="dropdownweekly-content">
						<a href="#">Week 1</a>
						<a href="#">Week 2</a>
						<a href="#">Week 3</a>
						<a href="#">Week 4</a>
					</div>
				</div>

				<div class="dropdownmonthly">
					<button class="dropmonthlybtn">Monthly</button>
					<div class="dropdownmonthly-content">
						<a href="#">January</a>
						<a href="#">February</a>
						<a href="#"> March</a>
						<a href="#">April</a>
						<a href="#">May</a>
						<a href="#">June</a>
						<a href="#">July</a>
						<a href="#">August</a>
						<a href="#">September</a>
						<a href="#">October</a>
						<a href="#">November</a>
						<a href="#">December</a>
					</div>
				</div>

				<br>

				<div class="chart">
				<br>
				<br>
				<br>
					<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

					<script>
					var xValues = [50,60,70,80,90,100,110,120,130,140,150];
					var yValues = [7,8,8,9,9,9,10,11,14,14,16];

					new Chart("myChart", {
					type: "line",
					data: {
					labels: xValues,
					datasets: [{
					fill: false,
					lineTension: 0,
					backgroundColor: "rgba(0,0,255,1.0)",
					borderColor: "rgba(0,0,255,0.1)",
					data: yValues
					}]
					},
					options: {
					legend: {display: false},
					scales: {
					yAxes: [{ticks: {min: 6, max:16}}],
					}
					}
					});
					</script>
				</div>
			</div>
		</div>
	</div>
</body>
</html>