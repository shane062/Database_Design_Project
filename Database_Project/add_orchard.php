<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['add_orchard'])) {
		$orchard_name = $_POST['orchard_name'];
		$orchard_address = $_POST['orchard_address'];
		$block_amount = $_POST['block_amount'];
		$person_in_charge = $_POST['person_in_charge'];
		
		
		$count_orchard = mysqli_query($db, "SELECT OrchardID FROM orchard");
		while($query_orchard = mysqli_fetch_array($count_orchard)) {		
			$orchardid = $query_orchard['OrchardID'];
		}
		$orchardid++;	
		$adminid = $_SESSION['adminid'];
		
		$add_orchard = "INSERT INTO orchard (OrchardID,OrchardName,OrchardAddress,AdminID) VALUES ('$orchardid','$orchard_name','$orchard_address','$adminid')";
		mysqli_query($db, $add_orchard) or die(mysqli_error($db));
		
		while($block_amount > 0) {
			$count_block = mysqli_query($db, "SELECT BlockID FROM block");
			while($query_block = mysqli_fetch_array($count_block)) {
				$blockid = $query_block['BlockID'];
			}
			$blockid++;
			
			$add_block = "INSERT INTO block (BlockID,OrchardID) VALUES ('$blockid','$orchardid')";
			mysqli_query($db, $add_block) or die("block: ".mysqli_error($db));
			$block_amount--;
		}
		
		if(!empty($person_in_charge)) {
			$date = date("Y-m-d H:i:s");
			$add_person = "INSERT INTO orchard_management (OrchardID,StaffID,DateStartManage) 
					 VALUES ('$orchardid', '$person_in_charge','$date')";
			$add_person_history = "INSERT INTO orchard_management_history (OrchardID,StaffID,DateStartManage) 
					 VALUES ('$orchardid', '$person_in_charge','$date')";
		
			mysqli_query($db, $add_person) or die(mysqli_error($db));
			mysqli_query($db, $add_person_history) or die(mysqli_error($db));
		}
		
		echo '<script>alert("Orchard added");</script>';
		echo '<script>window.location.href="manage_orchard.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Add Orchard</title>
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
		<a style="padding-left:20px;" href="manage_orchard.php">Back</a>
		
		<center>
			<h1>Add Orchard</h1>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Orchard Name</td>
						<td>
							<input autocomplete=off type=text name="orchard_name" required />
						</td>
					</tr>
					<tr>
						<td>Orchard Address</td>
						<td>
							<textarea autocomplete=off cols=50 rows=5 name="orchard_address"  required></textarea>
						</td>
					</tr>
					<tr>
						<td>Block Amount</td>
						<td>
							<input autocomplete=off type=number min=1 name="block_amount" required />
						</td>
					</tr>
					<tr>
						<td>Person In Charge</td>
						<td>
							<select name="person_in_charge">
								<?php
									$sel_worker_not_ic = "SELECT * FROM staff WHERE StaffID NOT IN (SELECT StaffID FROM orchard_management)";
									$worker_list = mysqli_query($db, $sel_worker_not_ic);
									$query = mysqli_fetch_array($worker_list);
									if($query == null)
										echo '<option value="">No available worker</option>';
									else {
										echo '<option value="">Select worker</option>';
										$worker_list = mysqli_query($db, $sel_worker_not_ic);
										while($query = mysqli_fetch_array($worker_list)) {
											$sel_worker_name = mysqli_query($db, "SELECT UserName FROM user WHERE UserID='".$query['UserID']."' ");
											$worker_name = mysqli_fetch_array($sel_worker_name);
											echo '<option value="'.$query['StaffID'].'">'.$worker_name['UserName'].'</option>';
										}
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<br/>
				<input type=submit name="add_orchard" value="Add"/>
			</form>
		</center>
    </body>
</html>