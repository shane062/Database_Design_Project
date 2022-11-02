<?php
	include 'dbConnection_arngren.php';
	$fullName = $email = $password = $password2 = $fullNameError = $lnameError = $emailError = $phoneError = $passwordError = $password2Error ="";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if (isset($_POST['submit'])) {
		
		$fullName = $_POST['fullName'];
		$email = $_POST['email'];
		/*$phonenumber = $_POST['phonenumber'];*/
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		$number = "/[0-9]/";
		$namevalid = "/^[A-Z]+[a-z]*$/";
		/*$phonevalid = "/(\+?6?01)[02-46-9]-*[0-9]{7}$|^(\+?6?01)[1]-*[0-9]{8}$/";
		$passwordvalid = "~/^(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])(?=(.*\d){6})(?!.* )/~";*/

		if (ctype_space($fullName)) {
			$fullNameError = "*First Name cannot be Blank!*";
            }
            else{
            	if (!preg_match("/^([A-Z]){1}([a-z]){1,}$/", trim($fullName))) {
            	$fullNameError = "*First Character must be Uppercase and Follow by Lowercase!*";
            	}
            	if (preg_match($number,trim($fullName))) {
				$fullNameError = "*First Name cannot be Numbers!*";
            	}
            }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailError = "*Invalid email Format!*";
            }

        /*if(!preg_match($phonevalid, $phonenumber)){
        	$phoneError = "*Invalid Phone Number!*";
        }
		
		if(!preg_match($passwordvalid, $password)){
        	$passwordError = "*Password must contain ONE upppercase, ONE lowercase,\nONE special character, numbers and no space!*";
        }*/

		if ($password2 != $password) {
			$password2Error = "*Confirm Password does not match!*";
		}

		if (empty($fullNameError)&&empty($lnameError)&&empty($emailError)&&empty($phoneError)&&empty($passwordError)&&empty($password2Error)) {
				
				
				/*if($conn->connect_error){
				echo "$conn->connect_error";
				die("Connection Failed : ". $conn->connect_error);
				} else {*/
				addAccount($fullName, $email, $password);
				$container = "hidden";
				$after = "visible";
				header("location: loginUser.php");
		}
		}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Arngren | Registration</title>
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
			height: 650px;
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
			height: 490px;
			position: absolute;
			right: 250px;		
			border: 3px solid rgb(237,237,237);
		}

		.formheader{
			font-family: 'Trebuchet MS', sans-serif;
			font-size: 20px;
		}

		.innerform{
			margin-bottom: 4px;
			position: relative;
		}

		.form input{
			display: block;
			border-radius: 12px;
			font-size: 12px;
			width: 7.5cm;
			padding: 10px ;
			margin-right: auto;
			margin-left: auto;
			border-width:2.5px;
		}

		.submit{
			background-color: rgba(196, 91, 86, 0.7);
			font-family: 'Trebuchet MS', sans-serif;
			color: white;
			width: 7.5cm;
			position: absolute;
			margin-left: auto;
			margin-right: auto;
			left: 0;
			right: 0;
			text-align: center;
			bottom: 2.75cm;

		}

		.reset{
			font-family: 'Trebuchet MS', sans-serif;
			width: 7.5cm;
			position: absolute;
			margin-left: auto;
			margin-right: auto;
			left: 0;
			right: 0;
			text-align: center;
			bottom: 1.5cm;
		}

		.formfooter {
			font-family: 'Trebuchet MS', sans-serif;
			font-size: 13px;
		}

		.formfooter p{
			color: grey;
			bottom:0;
			position: absolute;
			left: 2.5cm;
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

		.after{
			background-color: white;
			padding-left: 20px;
			padding-right: 20px;
			border-radius: 12px;
			width: 9cm;
			height: 550px;
			position: absolute;
			right: 250px;	
			text-align: center;
			border: 3px solid rgb(237,237,237);
			visibility: hidden;

		}

		.after img{
			width: 100px;
			position: relative;
			top: 100px;
		}

		.aftertext{
			margin-top: 10px;
			position: relative;
			font-family: 'Trebuchet MS', sans-serif;
			font-size: 16px;
			top: 100px;
		}

		.afterinput{
			position: relative;
			top: 130px;
		}

		.afterinput input{
			display: block;
			border-radius: 12px;
			font-size: 15px;
			width: 7.5cm;
			padding: 10px ;
			margin-right: auto;
			margin-left: auto;
			background-color: rgba(196, 91, 86, 0.7);
			font-family: 'Trebuchet MS', sans-serif;
			color: white;
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

		.errorblock{
			display: block;
			height: 17px;
		}

		small{
			left: 17px;
			display: block;
			position: relative;
			font-size: 13px;
			color: red;
		}

		.innerform.error input{
			border: 2px solid red;
		}


		.innerform.success input{
			border: 2px solid rgb(50,205,50);
		}

		.container.after{
			visibility: hidden;
			visibility: <?=$container?>;
		}

		.after.success{
			visibility: visible;
			visibility: <?=$after?>;
		}

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			<h1>Registration</h1>
		</div>
	</div>
 	<div class="context">
 		<div class="contextimg">
			<figure>
			<img src = "arngrenlogo.PNG" alt="arngenlogo">
			<figcaption><h3>www.Arngren.net</h3>Appliances and Gadgets Online Shopping Platform</figcaption>
			</figure>
		</div>
		<div class="container" id="container">
			<div class="formheader">
				<h3>Registration</h3>
			</div>
			<form class="form" id="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
				<div class="innerform">
				<input type="text" placeholder="Full Name" id="fullName" name="fullName" required>
				<div class="errorblock">
				<small class="error"> <?php echo $fullNameError;?></small>
				</div>
				</div>		
				<div class="innerform">
				<input type="email" placeholder="Email" id="email" name="email" required>
				<div class="errorblock">
				<small class="error"> <?php echo $emailError;?></small>
				</div>
				</div>
				<div class="innerform">
				<input type="text" placeholder="Password" id="password" name="password" required>
				<div class="errorblock">
				<small class="error"> <?php echo $passwordError;?></small>
				</div>
				</div>
				<div class="innerform">
				<input type="text" placeholder="Confirm Password" id="password2" name="password2" required>
				<div class="errorblock">
				<small class="error"> <?php echo $password2Error;?></small>
				</div>
				</div>
				<div class="footerform">
				<input type="submit" name="submit" value="Sign Up" class="submit">
				<input type="reset" value="Clear" class="reset">
				</div>
			</form>
			
			<div class="formfooter">
				<p>Already have an account?
				<a href="loginUser.php">Log In</a>
				</p>
			</div>
		</div>
		<div class="after" id="after">
				<div class="afterimg">
					<img src = "greentick.PNG" alt="greentick">
				</div>
				<div class="aftertext">Congratulations, your account has been successfully created.</div>
				<div class="afterinput">
					<input type="button" value="Log In" onclick="location.href='loginUser.php';">
					<br>
					<input type="button" value="Back to Homepage" onclick="location.href='index.php';">
				</div>

		</div>
	</div>
	<div class="footer">
		<br>
		<hr>
		<p>&copy; 2021 ARNGREN. ALL RIGHTS RESERVED</p>
	</div>
	<!-- <script src="registration.js"></script>  -->
</body>
</html>
