<?php include "dbConnection_arngren.php";

	session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	//unset qunatity
	unset($_SESSION['qty_array']);
	
									
?>

<!DOCTYPE HTML>
<html lang = "en">

  <!---G03-Lowkey Mockup code for other page (electric vehicles)--->
  <!---1. Mohammad Hamka Izzuddin Bin Mohamad Yahya (73571)--->
  <!---2. Harith Zakwan Bin Zakaria (73484)------------------->
  <!---3. Iman Tarmizi Rosalina (73496)----------------------->
  <!---4. Lai Weng Hong (75351)------------------------------->

<head>
	<meta charset = "UTF-8">
	<title>Arngren | Shopping Cart</title>

	<!---external CSS--->
	<link rel = "stylesheet" href = "style.css">

	<script src="https://use.fontawesome.com/59805f286a.js"></script>
	<link rel="icon" type="image/x-icon" href="arngrenlogo.PNG">
	
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		h1{
			position: absolute;
			left: 225px;
			top: 15px;
			font-size: 55px;
			color: white;
			font-family: Arial black;
		}
		
		h2{
			position: absolute;
			left: 225px;
			top: 75px;
			color: #ecd846;
			font-family: Arial black;
		}
		
		table tr th {
			background-color: #7a3835;
		}
		
		.headercontainer {
			border-bottom: 2px solid #ecd846;
		}

		.ad {
			margin: 2.5% 10% 2.5% 10%;
			height: 20%;
			width: 80%;
			align-items: center;
			background-image: linear-gradient(#ffe4e3, #eba3a0, #c45b56);
		}

		.ad img {
			width: 1000px;
			height: 500px;
		}

		.featured {
			max-width: 1080px;
			margin: 2.5% 10% 2.5% 10%;
		}

		.featured a {
			margin: 0 0 2.5% ;
		}

		.featuredrow {
			
		}

		.featuredcolumn {
			border: 2px solid lightgrey;
			border-radius: 5px;
			min-width: 200px;
			padding: 5px;
		}

		.featuredcolumn img {
			width: 100%;
		}

		.featuredcolumn {
		  float: left;
		  width: 25%;
		  padding: 10px;
		  height: 350px;
		}

		/* Clear floats after the columns */
		.featuredrow:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		.content h2 {
			color: black;
			font-family: Georgia, serif;
			font-size: 45px;
		}

		.content {
			font-family: Helvetica;
			padding: 10px;
			background: #f1f1f1;
		}

		.centernav{
			position: absolute;
			left: 224px;
			top: 25px;
			font-size: 14.5px;
			color: white;
			font-family: Helvetica;
		}

		.centernav ul li {
			display: inline-block;
			list-style-type: none;
		}

		.centernav a.active {
		  color: #ecd846;
		}

		.centernav a:hover:not(.active) {
		  color: #ecd846;
		}

		.topnav{
			display: flex;
			align-items: top;
			padding: 10px;
		}

		.topnav nav{
			flex: 1;
			position: absolute;
			left: 1050px;
			text-align: right;
		}

		.topnav nav ul{
			display: inline-block;
			list-style-type: none;
		}

		.topnav li{
			color: white;
		}

		.topnav nav ul li{
			display: inline-block;
			margin-right: 20px;
		}

		.topnav a{
			text-decoration: none;
			font-family: Helvetica;
			color: white;
		}
		
		.topnav span {
			text-decoration: none;
			font-family: Helvetica;
			color: white;
		}

		.headercontainer{
			max-width: 1300px;
			margin: auto;
			padding-left: 25px;
			padding-right: 25px;
		}

		.header{
			/*background-image: linear-gradient(#7a3835, #c45b56, #db7772);*/
			background: #c45b56;
		}


		.footer{
			text-align: center;
			font-family: Helvetica;
			color: lightgrey;
			font-size: 12px;
			border-top: 2px solid lightgrey;
			margin: 40px;
			padding: 20px;
		}	

		/* Create two unequal columns that floats next to each other */
		/* Left column */
		.leftcolumn {   
		  float: left;
		  width: 75%;
		}

		/* Right column */
		.rightcolumn {
		  float: left;
		  width: 25%;
		  background-color: #f1f1f1;
		  padding-left: 20px;
		}

		/* Add a card effect for articles */
		.card {
		  background-color: white;
		  padding: 20px;
		  margin-top: 20px;
		}

		/* Clear floats after the columns */
		.row:after {
		  content: "";
		  display: table;
		  clear: both;
		}

		/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
		@media screen and (max-width: 800px) {
		  .leftcolumn, .rightcolumn {   
			width: 100%;
			padding: 0;
		  }
		}

		/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
		@media screen and (max-width: 400px) {
		  .topnav a {
			float: none;
			width: 100%;
		  }
		}

		.button {
			background-color: #4CAF50; /* Green */
			border: none;
			border-radius: 10px;
			color: white;
			padding: 15px 32px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
		}
		
		.content table {
			width: 100%;
			border: 1px solid black;
		}
		
		.content thead, tbody, th, tr {
			border: 1px solid black;
			background: #c45b56;
			padding: 2px;
			color: #ecd846;
		}
		
		button {
			padding: 5px;
			background: #c45b56;
			color: #ecd846;
		}
		
		button a {
			color: #ecd846;
			text-decoration: none;
		}
	</style>
</head>

<body>
	<div class = "header">
		<div class = "headercontainer">
			<div class = "topnav">
			<h1>www.ARNGREN.net</h1>
				<div class = "centernav">
					<ul>
						<li><a href="productList.php"><i class = "fa fa-arrow-left"></i> Continue Browsing</a></li>
						<!-- <a href="#">Home</a> **Substitute with line 15 for ATV (otherpage) -->
					</ul>
				</div>
				
				<div class = "logo">
					<img src = "arngrenlogo.PNG" width = "125px">
				</div>
				
				<div class = "title">
					<h2>Shopping Cart <i class = "fa fa-shopping-cart"></i></h2>
				</div>
				
				<nav>
					<ul>
						<?php
						   global $conn;
						   $sql = "SELECT fullName FROM user WHERE logStatus = 1;";
						   $result = mysqli_query($conn, $sql);
						
						   if ($result -> num_rows > 0)
						   {
							  while ($row = $result -> fetch_assoc())
							  {
								?>
									<li><a href = "editprofile.php">My Profile</a></li>
									<li>|</li>
									<li><a href = "logoutUser.php">Log Out</a></li>
									<?php
							  }
							}
							else
							{
								?>
									<li><a href = "registration.php">Sign Up</a></li>
									<li>|</li>
									<li><a href = "chooseLogin.php">Log In</a></li>
								<?php
							}
							?>
					</ul>
				</nav>
			</div>
		</div>
	</div>

	<div class = "content">
		<form>
			<table>
				<tr>
					<th></th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal (KR)</th>
				</tr>

				<?php
					//initialize total
					$total = 0;
					if(!empty($_SESSION['cart']))
					{
						//connection
						$con = new mysqli('localhost', 'p1_admin', 'dummy123', 'db_arngren');
						//create array of initial qty which is 1
						$index = 0;
						if(!isset($_SESSION['qty_array']))
						{
							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
						}
						$sql = "SELECT * FROM product WHERE productID IN (".implode(',',$_SESSION['cart']).")";
						$query = $con->query($sql);
						
						while($row = $query->fetch_assoc())
						{
						?>
						<tr style = "text-align: center;">
							<td>
								<button><a href="removeCart.php?removeID=<?php echo $index; ?>&index=<?php echo $index; ?>"><i class = "fa fa-minus-square"></i></a></button>
							</td>
							<td><?php echo $row['productName']; ?></td>
							<td><?php echo number_format($row['productPrice'], 2); ?></td>
								<input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
							<td><input type="number" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="		qty_<?php echo $index; ?>">
							</td>
							<td><?php echo number_format($_SESSION['qty_array'][$index]*$row['productPrice'], 2); ?></td>
							<?php $total += $_SESSION['qty_array'][$index]*$row['productPrice']; ?>
							<?php $_SESSION['total'] = $total; ?>
						</tr>
						<?php
						$index ++;
						}
						?>
						<tr>
							<td colspan="4" align="right" style="padding: 10px; background-color: #d68c88;"><b>Total (KR)</b></td>
							<td style="background-color: #d68c88; text-align: center;"><b><?php echo number_format($total, 2); ?></b></td>
						</tr>
						</table>
						<div class="btn" style = "float: right;">
							<button class="btn-clear"><a href="clearCart.php"><i class = "fa fa-trash"></i> Clear Cart</a></button>
							<button class="btn-checkout"><a href="payment.php"><i class = "fa fa-credit-card-alt"></i></ion-icon> Checkout</a></button>
						</div>
						<?php
					}
					else
					{
						?>
					<tr>
						<td colspan="5" style="text-align: center;">Cart is empty.</td>
					</tr>
					</table>
					<?php
					}
				?>
			
		</form>
	<div class = "footer">
		<p>&copy; 2021 ARNGREN. ALL RIGHTS RESERVED</p>
	</div>

	
</body>
</html>