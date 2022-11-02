<?php include "dbConnection_arngren.php";

	if(isset($_POST['insert'])){
    $orderID = $_POST['orderID'];
    $orderID = $_POST['userID'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $orderDate = $_POST['orderDate'];
    $orderTime = $_POST['orderTime'];
    $productName = $_POST['productName'];
    $Qty = $_POST['Qty'];
	$total = $_POST['total'];
	$address = $_POST['address'];
    $state = $_POST['state'];
	$city = $_POST['city'];
    $zip = $_POST['zip'];
		
        


		makePayment($orderID, $userID, $fullname, $email, $orderDate, $orderTime, $productName, $Qty, $total, $address, $state, $city, $zip);
	}
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

		.table-container{
			padding: 10%;
			margin: 40px auto;
		}
		.heading{
			font-size: 40px;
			text-align: center;
			color: #c45b56;
			margin-bottom: 40px;
		}
		.table{
			width: 100%;
			border-collapse: collapse;
		}
		.table thead{
			background-color: #7a3835;
		}
		.table thead tr th{
			font-size: 14px;
			font-weight: medium;
			letter-spacing: 0.35px;
			color: #ecd846;
			opacity: 1;
			padding: 12px;
			vertical-align: top;
			border: 1px solid #dee2e685;
		}
		.table tbody tr td{
			font-size: 14px;
			letter-spacing: 0.35px;
			font-weight: normal;
			color: #ecd846;
			background-color: #c45b56;
			padding: 8px;
			text-align: center;
			border: 1px solid #dee2e685;
		}
		.btn{
			width: 130px;
			text-decoration: none;
			line-height: 35px;
			display: inline-block;
			background-color: #ecd846;
			font-weight: medium;
			color: #c45b56;
			text-align: center;
			vertical-align: middle;
			user-select: none;
			border: 1px solid transparent;
			font-size: 14px;
			opacity: 1;
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
					<a class = "active" href = "DashboardTransactionRecord.php">
						<span class = "icon"><i class = "fa fa-bar-chart"></i></span>
						<span class = "title">Transaction Record</span>
					</a>
				</li>
				<li>
					<a href = "DashboardTransactionReport.php">
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
			<div class="table-container" style = "padding: 20px;">
				<h1 class="heading">Transaction Records</h1>
				<table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Product Quantity</th>
                    <th>Product Name</th>
                    <th>Total Price(excl. 6% Tax)</th>
                    <th>Customer Address</th>
                    <th>State/County/District</th>
                    <th>City</th>
                    <th>Zip</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td data-label="fullname"></td>
                    <td data-label="fullname"></td>
                    <td data-label="email"></td>
                    <td data-label="orderDate"></td>
                    <td data-label="orderTime"></td>
                    <td data-label="Qty"></td>
                    <td data-label="productName"></td>
                    <td data-label="orderID"></td>
                    <td data-label="total"></td>
                    <td data-label="address"></td>
                    <td data-label="state"></td>
                    <td data-label="city"></td>
                    <td data-label="zip"></td>

                </tr>
            </tbody>
            <?php
				displayRecord();
            ?>
        </table>
			</div>
			
		
		</div>
	</div>
</body>
</html>