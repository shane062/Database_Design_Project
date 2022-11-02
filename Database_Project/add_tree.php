<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Staff")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['add_tree'])) {
		$tree_name = $_POST['tree_name'];
		$tree_height = $_POST['tree_height'];
		$tree_diameter = $_POST['tree_diameter'];
		$tree_status = $_POST['tree_status'];
		$blockid = $_POST['blockid'];
		$date_planted = $_POST['date_planted'];
		
		if(empty($tree_status)) {
			echo '<script>alert("Please select tree status");</script>';
            echo '<script>window.history.back();</script>';
            return false;
		}
		if(empty($blockid)) {
			echo '<script>alert("Please select block");</script>';
            echo '<script>window.history.back();</script>';
            return false;
		}
		$count_tree = mysqli_query($db, "SELECT TreeID FROM tree");
		while($query_tree = mysqli_fetch_array($count_tree)) {		
			$treeid = $query_tree['TreeID'];
		}
		$treeid++;
		
		$add_tree = "INSERT INTO tree (TreeID,TreeName,TreeDiameter,TreeHeight,TreeStatus,DatePlanted,BlockID) VALUES ('$treeid', '$tree_name','$tree_diameter','$tree_height','$tree_status','$date_planted','$blockid')";
		
		mysqli_query($db, $add_tree) or die(mysqli_error($db));
		echo '<script>alert("Registration completed");</script>';
		echo '<script>window.location.href="staff_dashboard.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Add Tree</title>
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
		<a style="padding-left:20px;" href="staff_dashboard.php">Back</a>
		
		<center>
			<h2>Add Tree</h2>
		
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>
							Species Name:
						</td>
						<td>
							<input autocomplete=off type=text name="tree_name" required />
						</td>
					</tr>
					<tr>
						<td>
							Height (cm):
						</td>
						<td>
							<input autocomplete=off type=text name="tree_height" required />
						</td>
					</tr>
					<tr>
						<td>
							Diameter (cm):
						</td>
						<td>
							<input autocomplete=off type=text name="tree_diameter" required />
						</td>
					</tr>
					<tr>
						<td>
							Date Planted:
						</td>
						<td>
							<input type=date name="date_planted" required />
						</td>
					</tr>
					<tr>
						<td>
							Status:
						</td>
						<td>
							<select name="tree_status">
								<option value="">Select tree status</option>
								<option value="GREEN">GREEN</option>
								<option value="YELLOW">YELLOW</option>
								<option value="RED">RED</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Block ID:
						</td>
						<td>
							<select name="blockid">
								<option value="">Select block</option>
								<?php 
									$a = mysqli_query($db, "SELECT BlockID,OrchardID FROM block");
									while($b = mysqli_fetch_array($a)) {
										$c = mysqli_query($db, "SELECT OrchardName FROM orchard WHERE OrchardID='".$b['OrchardID']."' ");
										$d = mysqli_fetch_array($c);
										echo '<option value="'.$b['BlockID'].'">'.$b['BlockID'].' - '.$d['OrchardName'].'</option>';
									}
								?>
							</select>
						</td>
					</tr>
				</table>
				<br/>
				<input type="submit" name="add_tree" value="Add Tree">
			</form>
		</center>
    </body>
</html>