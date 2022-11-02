<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Database Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['add_company_admin'])) {
		$company_name = $_POST['company_name'];
		$loginid = $_POST['loginid'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		
		if($password != $repassword) {
			echo '<script>alert("Incorrect password");</script>';
			echo '<script>window.history.back();</script>';
			return false;
		}
		$count_admin = mysqli_query($db, "SELECT AdminID FROM company_admin");
		while($query_admin = mysqli_fetch_array($count_admin)) {		
			$adminid = $query_admin['AdminID'];
		}
		$adminid++;
		
		$add_comp_admin = "INSERT INTO company_admin (adminID,CompanyName,LoginID,Password) VALUES ('$adminid', '$company_name','$loginid','$password')";
		
		mysqli_query($db, $add_comp_admin) or die(mysqli_error($db));
		echo '<script>alert("Registration completed");</script>';
		echo '<script>window.location.href="manage_company_admin.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Add Company</title>
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
		
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout_button=">
			Log Out
		</a>
		<a style="padding-left:20px;" href="manage_company_admin.php">Back</a>
		
		<center>
			<h1>Add Company </h1>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Company Name</td>
						<td>
							<input autocomplete=off type=text name="company_name" required />
						</td>
					</tr>
					<tr>
						<td>Login ID</td>
						<td>
							<input autocomplete=off type=text name="loginid" required />
						</td>
					</tr>
					<tr>
						<td>Password</td>
						<td>
							<input autocomplete=off type=password name="password" required />
						</td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td>
							<input autocomplete=off type=password name="repassword" required />
						</td>
					</tr>
				</table>
				<br/>
				<input type=submit name="add_company_admin" value="Add"/>
			</form>
		</center>
    </body>
</html>