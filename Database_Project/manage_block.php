<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(!isset($_SESSION['orchardid'])) {
		$_SESSION['orchardid'] = $_POST['orchardid'];
		$orchardid = $_SESSION['orchardid'];
	}
	else {
		$orchardid = $_SESSION['orchardid'];
		$sel_orchardname = mysqli_query($db, "SELECT OrchardName FROM orchard WHERE OrchardID='$orchardid' ");
		$query_orchardname = mysqli_fetch_array($sel_orchardname);
	}
	
	if(isset($_POST['add_block'])) {
		$block_amount = $_POST['block_amount'];
		
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
	}
	
	if(isset($_POST['delete_block'])) {
		$blockid = $_POST['blockid'];
		mysqli_query($db, "DELETE FROM block WHERE BlockID='$blockid' ");
		echo '<script>alert("Deleted");</script>';
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
			function confirmDel() {
				return confirm("Confirm?");
			}
        </script>
		
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout_button=">
			Log Out
		</a>
		<a style="padding-left:20px;" href="manage_orchard.php">Back</a>
		
		<center>
			<h1>Manage Block</h1>
			<h2>Orchard Name: <?php echo $query_orchardname['OrchardName']; ?></h2>
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<input type=number min=1 name="block_amount" />
				<input type=submit name="add_block" value="Add New Block">
			</form>
			
			<br>
			
			
			<table>
				<tr>
					<td>Block ID</td>
					<td>Block Price (RM)</td>
				</tr>
				<?php $no=1;
						
					$sel_block = "SELECT * FROM block WHERE OrchardID='$orchardid'";
					$block = mysqli_query($db, $sel_block);
					
					while($query_block = mysqli_fetch_array($block)) {
				?>
				<tr>
					<td><?php echo $query_block['BlockID']; ?></td>
					<td><?php echo $query_block['BlockPrice']; ?></td>
					<td>
						<form method=POST action="edit_block.php">
							<input type=hidden name="blockid" value="<?php echo $query_block['BlockID']; ?>"/>
							<input type=submit value="Edit Block Price"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type=hidden name="blockid" value="<?php echo $query_block['BlockID']; ?>"/>
							<input type=submit name="delete_block" value="Delete Block" onclick="return confirmDel()"/>
						</form>
					</td>
				</tr>
				<?php $no++;} ?>
			</table>
		</center>
    </body>
</html>