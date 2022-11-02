<?php 
    require 'server.php';
	
	if(isset($_POST['register'])) {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$loginid = $_POST['loginid'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		
		if($password != $repassword) {
			echo '<script>alert("Incorrect password");</script>';
			echo '<script>window.history.back();</script>';
			return false;
		}
		
		$count_client = mysqli_query($db, "SELECT ClientID FROM client");
		while($query_client = mysqli_fetch_array($count_client)) {		
			$clientid = $query_client['ClientID'];
		}
		$clientid++;		
		
		$count_user = mysqli_query($db, "SELECT UserID FROM user");
		while($query_user = mysqli_fetch_array($count_user)) {
			$userid = $query_user['UserID'];
		}
		$userid++;
		
		$add_client = "INSERT INTO client (ClientID,UserID) VALUES ('$clientid', '$userid')";
		$add_user = "INSERT INTO user (UserID,UserName,UserPhoneNumber,UserLoginID,UserPassword,UserAddress) 
					 VALUES ('$userid', '$name','$phone','$loginid','$password','$address')";
		
		mysqli_query($db, $add_client) or die(mysqli_error($db));
		mysqli_query($db, $add_user) or die(mysqli_error($db));
		$_SESSION["user"] = "Client";
		$_SESSION["clientid"] = $clientid;
		echo '<script>alert("Registration completed");</script>';
		echo '<script>window.location.href="client_dashboard.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Register</title>
		<style type="text/css">
            a:link img {
                float:right;
                border-radius:10px;
                margin:3px 5px 0px 0px;
            }
            .header-search{
                background-color:black;
                border-radius: 4px 4px 4px 4px ;
                padding: 2px 2px 2px 2px ;
            }
            #s{
                background-color: #EEEEEE;
            }
        </style>
    </head>
    <body>
        <script>
            if ( window.history.replaceState )
                window.history.replaceState( null, null, window.location.href );
        </script>
		
		<a style="padding-left:20px;" href="index.php">Back</a>
		
		<center>
			<h1>Create New Client Account</h1>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Name:</td>
						<td>
							<input autocomplete=off type=text name="name" required />
						</td>
					</tr>
					<tr>
						<td>Phone Number:</td>
						<td>
							<input autocomplete=off type=text name="phone" required />
						</td>
					</tr>
					<tr>
						<td>Address:</td>
						<td>
							<textarea autocomplete=off cols=50 rows=5 name="address" required ></textarea>
						</td>
					</tr>
					<tr>
						<td>Login ID:</td>
						<td>
							<input autocomplete=off type=text name="loginid" required />
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input autocomplete=off type=password name="password" required />
						</td>
					</tr>
					<tr>
						<td>Confirm Password:</td>
						<td>
							<input autocomplete=off type=password name="repassword" required />
						</td>
					</tr>
				</table>
				<br/>
				<input type=submit name="register" value="Register"/>
			</form>
		</center>
    </body>
</html>