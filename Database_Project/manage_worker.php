<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['delete_worker'])) {
		mysqli_query($db, "DELETE FROM staff WHERE UserID='".$_POST['userid']."'");
		mysqli_query($db, "DELETE FROM user WHERE UserID='".$_POST['userid']."'");
		echo '<script>alert("Deleted");</script>
		      <script>window.location.href="'.$_SERVER['PHP_SELF'].'";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Manage Worker</title>
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
			
			function confirmDel() {
				return confirm("Confirm?");
			}
        </script>
		
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout_button=">
			Log Out
		</a>
		<a style="padding-left:20px;" href="company_admin_dashboard.php">Back</a>
		
		<center>
			<h1>Manage Worker</h1>
			
			<form method=POST action="add_worker.php">
				<input type="submit" name="record_tree" value="Add New Worker">
			</form>
			
			<br>
			
			
			<table>
				<tr>
					<td>No.</td>
					<td>Worker Name</td>
					<td>Worker Address</td>
				</tr>
				<?php $no=1;
					$sel_all_worker = "SELECT * FROM user,staff WHERE staff.UserID=user.UserID 
					                   AND staff.AdminID='".$_SESSION['adminid']."'";
					$all_worker_list = mysqli_query($db, $sel_all_worker);
					while($query = mysqli_fetch_array($all_worker_list)) {
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $query['UserName']; ?></td>
					<td><?php echo $query['UserAddress']; ?></td>
					<td>
						<form method=POST action="edit_worker.php">
							<input type="hidden" name="userid" value="<?php echo $query['UserID']; ?>"/>
							<input type="submit" value="Edit Info"/>
						</form>
					</td>
					<td>
						<form method=POST action="reset_password_worker.php">
							<input type="hidden" name="userid" value="<?php echo $query['UserID']; ?>"/>
							<input type="submit" value="Reset Password"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="hidden" name="userid" value="<?php echo $query['UserID']; ?>"/>
							<input type="submit" name="delete_worker" value="Delete" onclick="return confirmDel()"/>
						</form>
					</td>
				</tr>
				<?php $no++;} ?>
			</table>
		</center>
    </body>
</html>