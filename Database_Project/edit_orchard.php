<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['edit_orchard'])) {
		$orchard_name = $_POST['orchard_name'];
		$orchard_address = $_POST['orchard_address'];
		$person_in_charge = $_POST['person_in_charge'];
		$orchardid = $_POST['orchardid'];
		$date = date("Y-m-d H:i:s");
		
		$update_orchard = "UPDATE orchard SET OrchardName='$orchard_name',OrchardAddress='$orchard_address' WHERE OrchardID='$orchardid'";
		
		$a = mysqli_query($db, "SELECT * FROM orchard_management WHERE OrchardID='$orchardid'");
		$b = mysqli_fetch_array($a);
		
		if(!empty($person_in_charge)) {
			// Update
			if($b != null)
				$update_orchard_manage = "UPDATE orchard_management SET StaffID='$person_in_charge',DateStartManage='$date' WHERE OrchardID='$orchardid'";
			
			// Insert
			else {
				$update_orchard_manage = "INSERT INTO orchard_management (OrchardID,StaffID,DateStartManage) VALUES ('$orchardid','$person_in_charge','$date') ";
		
				$update_orchard_manage_history = "INSERT INTO orchard_management_history (OrchardID,StaffID,DateStartManage) VALUES('$orchardid','$person_in_charge','$date')";
				mysqli_query($db, $update_orchard_manage_history) or die(mysqli_error($db));
			}
			mysqli_query($db, $update_orchard_manage) or die(mysqli_error($db));
		}
		
		mysqli_query($db, $update_orchard) or die(mysqli_error($db));
		echo '<script>alert("Updated successfully");</script>
		      <script>window.location.href="manage_orchard.php";</script>';
	}
	
	if(isset($_POST['orchardid']))
		$OrchardID = $_POST['orchardid'];
	
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Edit Orchard Info</title>
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
		<a style="padding-left:20px;" href="manage_orchard.php">Back</a>
		
		<center>
			<h1>Edit Orchard</h1>
			
			<?php
				$sel_orchard = "SELECT * FROM orchard WHERE OrchardID='$OrchardID'";
				$orchard_info = mysqli_query($db, $sel_orchard);
				$query = mysqli_fetch_array($orchard_info);
			?>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Orchard Name:</td>
						<td>
							<input autocomplete=off type=text name="orchard_name" value="<?php echo $query['OrchardName']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>Orchard Address:</td>
						<td>
							<textarea autocomplete=off cols=50 rows=5 name="orchard_address"><?php echo $query['OrchardAddress']; ?></textarea>
						</td>
					</tr>
					<tr>
						<td>Person In Charge:</td>
						<td>
							<?php
								$sel_worker_not_ic = "SELECT * FROM staff WHERE StaffID NOT IN (SELECT StaffID FROM orchard_management) AND AdminID='".$_SESSION['adminid']."'";
								$worker_list = mysqli_query($db, $sel_worker_not_ic);
								$query_person = mysqli_fetch_array($worker_list);
								
								$a = mysqli_query($db, "SELECT * FROM staff WHERE StaffID IN (SELECT StaffID FROM orchard_management WHERE OrchardID='$OrchardID') ");
								$b = mysqli_fetch_array($a);
								
								// If no available worker
								if($query_person == null) {
									if($b != null) {
										$sel_worker_name = mysqli_query($db, "SELECT UserName FROM user WHERE UserID='".$b['UserID']."' ");
										$worker_name = mysqli_fetch_array($sel_worker_name);
										echo $worker_name['UserName'].' (Currently in charge)';
										echo '<input type=hidden name="person_in_charge" value="'.$b['StaffID'].'"/>';
									}
									echo '<i><br/>No other available worker to charge as orchard manager</i>';
								}
								// If there are available workers
								else {
									echo '<select name="person_in_charge">';
									echo '<option value="">Select worker</option>';
									
									// If there is currently person in charge
									if($b != null) {
										$sel_worker_name = mysqli_query($db, "SELECT UserName FROM user WHERE UserID='".$b['UserID']."' ");
										$worker_name = mysqli_fetch_array($sel_worker_name);
										echo '<option value="'.$b['StaffID'].'" selected>'.$worker_name['UserName'].' (Currently in charge)'.'</option>';
									}
									$worker_list = mysqli_query($db, $sel_worker_not_ic);
									
									while($query_person = mysqli_fetch_array($worker_list)) {
										$staffid = $query_person['StaffID'];
										$userid = $query_person['UserID'];
										
										$sel_worker_name = mysqli_query($db, "SELECT UserName FROM user WHERE UserID='$userid' ");
										$worker_name = mysqli_fetch_array($sel_worker_name);
										echo '<option value="'.$staffid.'" >'.$worker_name['UserName'].'</option>';
									}
									echo '</select>';
								}							
							?>
						</td>
					</tr>
				</table>
				<br/>
				<input type=hidden name="orchardid" value="<?php echo $OrchardID; ?>"/>
				<input type=submit name="edit_orchard" value="Update"/>
			</form>
		</center>
    </body>
</html>