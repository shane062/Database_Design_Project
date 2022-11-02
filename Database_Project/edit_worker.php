<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['userid']))
		$userid = $_POST['userid'];
	
	if(isset($_POST['edit_worker'])) {
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$loginid = $_POST['loginid'];
		$userid = $_POST['userid'];
		
		$update = "UPDATE user SET UserName='$name', UserPhoneNumber='$phone',UserAddress='$address', UserLoginID='$loginid' WHERE UserID='$userid'";
		mysqli_query($db, $update);
		echo '<script>alert("Updated successfully");</script>
		      <script>window.location.href="manage_worker.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Edit Worker Info</title>
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
			<h1>Edit Worker Info</h1>
			
			<?php
				$sel_worker = "SELECT * FROM user WHERE UserID='$userid'";
				$worker_list = mysqli_query($db, $sel_worker);
				$query = mysqli_fetch_array($worker_list);
			?>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Name</td>
						<td>
							<input autocomplete=off type=text name="name" value="<?php echo $query['UserName']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>Phone Number:</td>
						<td>
							<input autocomplete=off type=text name="phone" value="<?php echo $query['UserPhoneNumber']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>Address</td>
						<td>
							<textarea autocomplete=off cols=50 rows=5 name="address"><?php echo $query['UserAddress']; ?></textarea>
						</td>
					</tr>
					<tr>
						<td>Login ID:</td>
						<td>
							<input autocomplete=off type=text name="loginid" value="<?php echo $query['UserLoginID']; ?>"/>
						</td>
					</tr>
				</table>
				<br/>
				<input type=hidden name="userid" value="<?php echo $userid; ?>"/>
				<input type=submit name="edit_worker" value="Update"/>
			</form>
		</center>
    </body>
</html>