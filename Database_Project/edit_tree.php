<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Staff")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['treeid']))
		$treeid = $_POST['treeid'];
	
	if(isset($_POST['edit_tree'])) {
		$treeid = $_POST['treeid'];
		$tree_name = $_POST['tree_name'];
		$tree_height = $_POST['tree_height'];
		$tree_diameter = $_POST['tree_diameter'];
		$tree_status = $_POST['tree_status'];
		$date_planted = $_POST['date_planted'];
		
		$update_tree = "UPDATE tree SET TreeName='$tree_name',TreeHeight='$tree_height',TreeDiameter='$tree_diameter',TreeStatus='$tree_status',DatePlanted='$date_planted' WHERE TreeID='$treeid' ";
		mysqli_query($db, $update_tree);
		echo '<script>alert("Updated successfully");</script>
		      <script>window.location.href="staff_dashboard.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Edit Tree Info</title>
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
		<a style="padding-left:20px;" href="staff_dashboard.php">Back</a>
		
		<center>
			<h2>Edit Tree Info</h2>
			
			<?php $no=1;
					$sel_tree = "SELECT * FROM tree WHERE TreeID='$treeid'";
					$tree_list = mysqli_query($db, $sel_tree);
					$query = mysqli_fetch_array($tree_list);
					
					function selectG($status) {
						if($status == "GREEN")
							echo "selected";
					}
					
					function selectY($status) {
						if($status == "YELLOW")
							echo "selected";
					}
					
					function selectR($status) {
						if($status == "RED")
							echo "selected";
					}
			?>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>
							Species Name:
						</td>
						<td>
							<input autocomplete=off type="text" name="tree_name" value="<?php echo $query['TreeName']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							Height:
						</td>
						<td>
							<input autocomplete=off type="text" name="tree_height" value="<?php echo $query['TreeHeight']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							Diameter:
						</td>
						<td>
							<input autocomplete=off type="text" name="tree_diameter" value="<?php echo $query['TreeDiameter']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							Date Planted:
						</td>
						<td>
							<input autocomplete=off type=date name="date_planted" value="<?php echo $query['DatePlanted']; ?>"/>
						</td>
					</tr>
					<tr>
						<td>
							Status:
						</td>
						<td>
							<select name="tree_status">
								<option value="">Select tree status</option>
								<option value="GREEN" <?php selectG($query['TreeStatus']); ?> >GREEN</option>
								<option value="YELLOW" <?php selectY($query['TreeStatus']); ?> >YELLOW</option>
								<option value="RED" <?php selectR($query['TreeStatus']); ?> >RED</option>
							</select>
						</td>
					</tr>
				</table>
				<br/>
				<input type=hidden name="treeid" value="<?php echo $treeid; ?>">
				<input type=submit name="edit_tree" value="Update">
			</form>
		</center>
    </body>
</html>