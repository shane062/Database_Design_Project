<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['userid']))
		$userid = $_POST['userid'];
	
	if(isset($_POST['reset_password_worker'])) {
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$userid = $_POST['userid'];
		
		if($password != $repassword) {
			echo '<script>alert("Incorrect password");</script>';
			echo '<script>window.history.back();</script>';
			return false;
		}
		
		$update = "UPDATE user SET UserPassword='$password' WHERE UserID='$userid'";
		mysqli_query($db, $update);
		echo '<script>alert("Updated successfully");</script>
		      <script>window.location.href="manage_worker.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Reset Password Company Admin</title>
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
	
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout_button=">
			Log Out
		</a>
		<a style="padding-left:20px;" href="manage_worker.php">Back</a>
		
		<center>
			<h1>Reset Password</h1>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>New Password:</td>
						<td><input autocomplete=off type=password name="password"/></td>
					</tr>
					<tr>
						<td>Confirm New Password:</td>
						<td><input autocomplete=off type=password name="repassword"/></td>
					</tr>				
				</table>
				<br/>
				<input type="hidden" name="userid" value="<?php echo $userid; ?>"/>
				<input type="submit" name="reset_password_worker" value="Reset Password"/>
			</form>
		</center>
    </body>
</html>