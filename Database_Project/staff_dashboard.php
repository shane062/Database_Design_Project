<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Staff")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['delete_tree'])) {
		$treeid = $_POST['treeid'];
		mysqli_query($db, "DELETE FROM tree WHERE TreeID='$treeid' ");
		echo '<script>alert("Deleted");</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Staff Dashboard</title>
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
		
		<center>
			<h1>Manage Tree Record</h1>
			<form action="add_tree.php">
				<input type="submit" name="add_tree" value="Add New Tree">
			</form>
			<br/>
			<table>
				<tr>
					<td>No.</td>
					<td>Tree Name</td>
					<td>Diameter (cm)</td>
					<td>Height (cm)</td>
					<td>Status</td>
					<td>Date Planted</td>
					<td>Block No</td>
				</tr>
				<?php $no=1;
					$sel_all_tree = "SELECT * FROM tree";
					$all_tree_list = mysqli_query($db, $sel_all_tree);
					while($query = mysqli_fetch_array($all_tree_list)) {
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $query['TreeName']; ?></td>
					<td><?php echo $query['TreeDiameter']; ?></td>
					<td><?php echo $query['TreeHeight']; ?></td>
					<td><?php echo $query['TreeStatus']; ?></td>
					<td><?php echo $query['DatePlanted']; ?></td>
					<td><?php echo $query['BlockID']; ?></td>
					<td>
						<form method=POST action="edit_tree.php">
							<input type=hidden name="treeid" value="<?php echo $query['TreeID']; ?>"/>
							<input type=submit value="Edit Info"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type=hidden name="treeid" value="<?php echo $query['TreeID']; ?>"/>
							<input type=submit name="delete_tree" value="Delete" onClick="return confirmDel()"/>
						</form>
					</td>
				</tr>
				<?php $no++;} ?>
			</table>
		</center>
    </body>
</html>