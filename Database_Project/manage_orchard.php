<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['delete_orchard'])) {
		mysqli_query($db, "DELETE FROM orchard WHERE OrchardID='".$_POST['orchardid']."'");
		mysqli_query($db, "DELETE FROM orchard_management WHERE OrchardID='".$_POST['orchardid']."'");
		mysqli_query($db, "DELETE FROM block WHERE OrchardID='".$_POST['orchardid']."'");
		echo '<script>alert("Deleted");</script>
		      <script>window.location.href="'.$_SERVER['PHP_SELF'].'";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Manage Orchard</title>
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
			<h1>Manage Orchard</h1>
			
			<form method=POST action="add_orchard.php">
				<input type="submit" name="record_tree" value="Add New Orchard">
			</form>
			
			<br>
			
			
			<table>
				<tr>
					<td>No.</td>
					<td>Orchard Name</td>
					<td>Orchard Address</td>
					<td>Block Amount</td>
					<td>Current Person In Charge</td>
				</tr>
				<?php $no=1;
					$sel_all_orchard = "SELECT * FROM orchard WHERE AdminID='".$_SESSION['adminid']."'";
					$all_orchard_list = mysqli_query($db, $sel_all_orchard);
					while($query = mysqli_fetch_array($all_orchard_list)) {
						
						$count_orchard_block = "SELECT COUNT(BlockID) AS block_amount FROM block WHERE OrchardID='".$query['OrchardID']."'";
						$query_block = mysqli_fetch_array(mysqli_query($db, $count_orchard_block));
						
						$sel_person = "SELECT UserName FROM user WHERE UserID IN(SELECT UserID FROM staff WHERE StaffID IN(SELECT StaffID FROM orchard_management WHERE OrchardID='".$query['OrchardID']."' ))";
						$a = mysqli_query($db, $sel_person) or die(mysqli_error($db));
						$query_person = mysqli_fetch_array($a);
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $query['OrchardName']; ?></td>
					<td><?php echo $query['OrchardAddress']; ?></td>
					<td><?php echo $query_block['block_amount']; ?></td>
					<td><?php if($query_person != null)
								echo $query_person['UserName'];
							  else 
								  echo "Not selected yet";					?></td>
					<td>
						<form method=POST action="edit_orchard.php">
							<input type=hidden name="orchardid" value="<?php echo $query['OrchardID']; ?>"/>
							<input type=submit value="Edit Info"/>
						</form>
					</td>
					<td>
						<form method=POST action="manage_block.php">
							<input type=hidden name="orchardid" value="<?php echo $query['OrchardID']; ?>"/>
							<input type=submit value="Manage Block"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type=hidden name="orchardid" value="<?php echo $query['OrchardID']; ?>"/>
							<input type=submit name="delete_orchard" value="Delete" onclick="return confirmDel()"/>
						</form>
					</td>
				</tr>
				<?php $no++;} ?>
			</table>
		</center>
    </body>
</html>