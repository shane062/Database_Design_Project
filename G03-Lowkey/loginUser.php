<?php
	include "dbConnection_arngren.php";

	if (isset($_POST['submit']))
	{
		global $conn;
		$loginid = $_POST['loginid'];
		$password = $_POST['password'];

		$sql = "UPDATE user SET logStatus = 1 WHERE email = '$loginid' AND password = '$password'";
		$result = mysqli_query($conn, $sql);
		
		$sql = "SELECT * FROM user WHERE email = '$loginid' AND password = '$password'";
		$result = mysqli_query($conn, $sql);

		if ($result !== false && $result->num_rows > 0)
		{
			while ($row = $result -> fetch_assoc())
			{
				session_start();
				echo "<script>alert('You have successfully Log In');</script>";
				//direct to registed member homepage
				header("Location: index.php");
			}
		}
		else
		{
			echo "<script>alert('Invalid Login ID or Password');</script>";
		}
	}
	
	if (isset($_POST['guest']))
	{
		global $conn;
		session_start();
		header("Location: index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arngren | Log In</title>
	<link rel="icon" type="image/x-icon" href="arngrenlogo.PNG">
	<style type="text/css">
		.header{
			display: flex;
			padding: 5px;
			background-color: white;
			align-items: top;
			font-family: 'Trebuchet MS', sans-serif;
		}

		.logo img{
			width: 90px;
			padding-left: 100px; 
			padding-right: 5px;
		}

		.logotext h1{
			padding-left: 5px;
			padding-right: 5px;
			font-size: 25px;
			color: #c45b56;
		}

		.logintext h1{
			padding-left: 5px;
			font-size: 25px;
		}

		body { background-color:#c45b56;
			margin: 0;
		}

		.context {
			height: 600px;
			align-items: center;
			display: flex;
		}

		.contextimg img{
			width: 300px;
			position: relative;
			left: 350px;
		
		}

		figcaption{
			position: relative;
			left: 270px;
			color: white;
			font-size: 20px;
			font-family: 'Trebuchet MS', sans-serif;
			text-align: center;

		}

		.container {
			background-color: white;
			padding-left: 20px;
			padding-right: 20px;
			border-radius: 12px;
			width: 9cm;
			height: 450px;
			position: absolute;
			right: 250px;			
		}
		
		.container button{
			display: block;
			border-radius: 12px;
			font-size: 12px;
			width: 7.5cm;
			padding: 10px ;
			margin-right: auto;
			margin-left: auto;
			background-color: rgba(196, 91, 86, 0.7);
			font-family: 'Trebuchet MS', sans-serif;
			color: white;
			width: 7.5cm;
		}
		
		.container a {
			text-decoration: none;
			font-family: 'Trebuchet MS', sans-serif;
			color: white;
			width: 7.5cm;
		}

		.formheader{
			font-family: 'Trebuchet MS', sans-serif;
			font-size: 20px;
		}

		.form input{
			display: block;
			border-radius: 12px;
			font-size: 12px;
			width: 7.5cm;
			padding: 10px ;
			margin-right: auto;
			margin-left: auto;
		}

		.submit{
			background-color: rgba(196, 91, 86, 0.7);
			font-family: 'Trebuchet MS', sans-serif;
			color: white;
			width: 7.5cm;
		}

		.formfooter {
			font-family: 'Trebuchet MS', sans-serif;
			text-align: center;
			font-size: 13px;
		}

		.formfooter p{
			color: grey;
		}

		.formfooter a:link{
			color: rgb(196, 91, 86);
			text-decoration: none;
			font-weight: bold;
		}

		.formfooter a:visited{
			color: rgb(196, 91, 86);
			text-decoration: none;
			font-weight: bold;
		}

		.footer{
			background-color: white;
			text-align: center;
			height: 90px;
			color: grey;
			font-size: 12px;
		}

		.footer hr{
			width: 80%;
		}

	</style>
</head>
<body>
	<div class="header">
		<div class="logo">
			<img src = "arngrenlogo.PNG" alt="logo" >
		</div>
		<div class="logotext">
			<h1>www.Arngren.net</h1>
		</div>
		<div class="logintext"> 
			<h1><span style = "color: #ecd846;">User </span>Log In</h1>
		</div>
	</div>
 	<div class="context">
		<div class="contextimg">
			<figure>
			<img src = "arngrenlogo.PNG" alt="arngenlogo">
			<figcaption><h3>www.Arngren.net</h3>Appliances and Gadgets Online Shopping Platform</figcaption>
			</figure>
		</div>
		<div class="container">
			<div class="formheader">
				<h3><span style = "color: #c45b56;">User </span>Log In</h3>
			</div>
			<form class="form" method="POST" action="loginUser.php">
				<br>
				<input type="" placeholder="Email" id="loginid" name="loginid" required>
				<br>
				<input type="password" placeholder="Password" id="password" name="password" required>
				<br>
				<input type="submit" value="LOG IN" class="submit" name="submit">
				<br>
			</form>
			<form class="form" method="POST">
				<input type="submit" value="CONTINUE AS GUEST" class="submit" name="guest">
			</form>
			<br>
			<button style = "background-color: #ecd846;"><a href="chooseLogin.php">CHANGE USER TYPE</a></button>
			<br>
			<hr>
			
			<div class="formfooter">
				<p>New to www.Arngren.net?
				<a href="registration.php">Sign Up</a>
				</p>
			</div>
		</div>
	</div>
	<div class="footer">
		<br>
		<hr>
		<p>&copy; 2021 ARNGREN. ALL RIGHTS RESERVED</p>
	</div>
</body>
</html>