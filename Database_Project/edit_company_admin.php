<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Database Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['adminid'])) {
		$adminid = $_POST['adminid'];
	}
	
	if(isset($_POST['update_company_admin'])) {
		$company_name = $_POST['company_name'];
		$loginid = $_POST['loginid'];
		$adminid = $_POST['adminid'];
		
		$update = "UPDATE company_admin SET CompanyName='$company_name', LoginID='$loginid' WHERE AdminID='$adminid'";
		mysqli_query($db, $update);
		echo '<script>alert("Updated successfully");</script>
		      <script>window.location.href="manage_company_admin.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Edit Company</title>
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
		<a style="padding-left:20px;" href="manage_company_admin.php">Back</a>
		
		<center>
			<h1>Edit Company</h1>
			
			<?php
				$sel_all_comp_admin = "SELECT CompanyName,LoginID FROM company_admin WHERE AdminID='$adminid'";
				$all_comp_admin_list = mysqli_query($db, $sel_all_comp_admin);
				$query = mysqli_fetch_array($all_comp_admin_list)
			?>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Company Name:</td>
						<td><input autocomplete=off type=text name="company_name" value="<?php echo $query['CompanyName']; ?>"/></td>
					</tr>
					<tr>
						<td>Login ID</td>
						<td><input autocomplete=off type=text name="loginid" value="<?php echo $query['LoginID']; ?>"/></td>
					</tr>	
				</table>
				<br/>
				<input type="hidden" name="adminid" value="<?php echo $adminid; ?>"/>
				<input type="submit" name="update_company_admin" value="Update"/>
			</form>
			
		</center>
    </body>
</html>