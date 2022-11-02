<?php
	$db = mysqli_connect("localhost", "root", "", "database_g18");
    session_start();
    date_default_timezone_set("Asia/Kuala_Lumpur");
    
    if(!isset($_SESSION["user"])) {
        $_SESSION["user"] = "";
    }
    
	/* Login */
	/////////////////////////////////////////////////////////////////
    if(isset($_POST['login_button'])) {
        $_SESSION["UserLoginID"] = $_POST['userloginid'];
		$password = $_POST['password'];
		$role = $_POST['role'];

		if(empty($role)) {
            echo '<script>alert("Please enter your role");</script>';
            echo '<script>window.history.back();</script>';
            return false;
        }
        if(empty($_SESSION["UserLoginID"])) {
            echo '<script>alert("Please enter your login ID");</script>';
            echo '<script>window.history.back();</script>';
            return false;
        }

        if(empty($password)) {
            echo '<script>alert("Please enter your password");</script>';
            echo '<script>window.history.back();</script>';
            return false;
        }
		
		if($role == "Database Admin") {
			// If login fail
			if (($_SESSION["UserLoginID"] != "admin") && ($password != "admin123")) {
				echo '<script>alert("Incorrect username/password/role");</script>';
				echo '<script>window.history.back();</script>';
			}
			else {
				$_SESSION["user"] = "Database Admin";
				header("Location: database_admin_dashboard.php");
			}
		}
		else if($role == "Company Admin") {
			$admin = mysqli_query($db ,"SELECT * FROM company_admin WHERE LoginID = '".$_SESSION["UserLoginID"]."' AND Password='".$password."'") or die(mysqli_error($db));
			$query_admin = mysqli_fetch_array($admin);
			
			if($query_admin != null) {
				$_SESSION["user"] = "Company Admin";
				$_SESSION["adminid"] = $query_admin['AdminID'];
				header("Location: company_admin_dashboard.php");
			}
			else {
				echo '<script>alert("Incorrect username/password/role");</script>';
				echo '<script>window.history.back();</script>';
			}
		}
		else {
			
			$result = mysqli_query($db ,"SELECT * FROM user WHERE UserLoginID = '".$_SESSION["UserLoginID"]."' AND userpassword = '$password' ") or die(mysqli_error($db));
			$query = mysqli_fetch_array($result);		
		
			// If login fail
			if (($query['UserLoginID'] != $_SESSION["UserLoginID"]) && ($query['UserPassword'] != $password)) {
				echo '<script>alert("Incorrect username/password/role");</script>';
				echo '<script>window.history.back();</script>';
			}
			// If login successful
			else {
				if($role == "Worker") {
					$staff = mysqli_query($db ,"SELECT StaffID FROM staff WHERE UserID = '".$query["UserID"]."' ") or die(mysqli_error($db));
					$query_staff = mysqli_fetch_array($staff);
					
					if($query_staff != null) {
						$_SESSION["user"] = "Staff";
						header("Location: staff_dashboard.php");
					}
					else {
						echo '<script>alert("Incorrect username/password/role");</script>';
						echo '<script>window.history.back();</script>';
					}
				}
				else if($role == "Client") {
					$client = mysqli_query($db ,"SELECT ClientID FROM client WHERE UserID = '".$query["UserID"]."' ") or die(mysqli_error($db));
					$query_client = mysqli_fetch_array($client);
					
					if($query_client != null) {
						$_SESSION["user"] = "Client";
						$_SESSION["clientid"] = $query_client['ClientID'];
						header("Location: client_dashboard.php");
					}
					else {
						echo '<script>alert("Incorrect username/password/role");</script>';
						echo '<script>window.history.back();</script>';
					}
				}
			}
		}
	}
	/////////////////////////////////////////////////////////////////
	
	
    /* Log Out */
	/////////////////////////////////////////////////////////////////
    if(isset($_GET['logout_button'])) {
        $_SESSION["user"] = "";
    }
	/////////////////////////////////////////////////////////////////
	
?>