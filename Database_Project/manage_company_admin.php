<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Database Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['delete_company_admin'])) {
		mysqli_query($db, "DELETE FROM company_admin WHERE AdminID='".$_POST['adminid']."'");
		echo '<script>alert("Deleted");</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Manage Company</title>
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
            function confirmDel() {
				return confirm("Confirm?");
			}
        </script>
		
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout_button=">
			Log Out
		</a>
		<a style="padding-left:20px;" href="database_admin_dashboard.php">Back</a>
		
		<center>
			<h1>Manage Company</h1>
			
			<form method=POST action="add_company_admin.php">
				<input type="submit" name="record_tree" value="Add Company">
			</form>
			
			<br>
			
			
			<table>
				<tr>
					<td>No.</td>
					<td>Company Name</td>
					<td>Login ID</td>
					<td>Password</td>
				</tr>
				<?php $no=1;
					$sel_all_comp_admin = "SELECT * FROM company_admin";
					$all_comp_admin_list = mysqli_query($db, $sel_all_comp_admin);
					while($query = mysqli_fetch_array($all_comp_admin_list)) {
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $query['CompanyName']; ?></td>
					<td><?php echo $query['LoginID']; ?></td>
					<td><?php echo $query['Password']; ?></td>
					<td>
						<form method=POST action="edit_company_admin.php">
							<input type="hidden" name="adminid" value="<?php echo $query['AdminID']; ?>"/>
							<input type="submit" value="Edit Profile"/>
						</form>
					</td>
					<td>
						<form method=POST action="reset_password_company_admin.php">
							<input type="hidden" name="adminid" value="<?php echo $query['AdminID']; ?>"/>
							<input type="submit" value="Reset Password"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type="hidden" name="adminid" value="<?php echo $query['AdminID']; ?>"/>
							<input type="submit" name="delete_company_admin" value="Delete" onclick="return confirmDel()"/>
						</form>
					</td>
				</tr>
				<?php $no++;}?>
			</table>
		</center>
    </body>
</html>