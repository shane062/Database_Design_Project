<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['edit_block_price'])) {
		$blockid = $_POST['blockid'];
		$price = $_POST['price'];
		
		$update_price = "UPDATE block SET BlockPrice='$price' WHERE BlockID='$blockid'";

		mysqli_query($db, $update_price) or die(mysqli_error($db));
		echo '<script>alert("Updated successfully");</script>
		      <script>window.location.href="manage_block.php";</script>';
	}
	
	if(isset($_POST['blockid']))
		$blockid = $_POST['blockid'];
	
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
		<a style="padding-left:20px;" href="manage_block.php">Back</a>
		
		<center>
			<h1>Edit Orchard</h1>
			
			<?php
				$sel_block = "SELECT * FROM block WHERE BlockID='$blockid' ";
				$query_block = mysqli_fetch_array(mysqli_query($db, $sel_block));
			?>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<table>
					<tr>
						<td>Block ID:</td>
						<td><?php echo $query_block['BlockID']; ?></td>
					</tr>
					<tr>
						<td>Block Price</td>
						<td>
							<input autocomplete=off type=text name="price" value="<?php echo $query_block['BlockPrice']; ?>"/>
						</td>
					</tr>
				</table>
				<br/>
				<input type=hidden name="blockid" value="<?php echo $blockid; ?>"/>
				<input type=submit name="edit_block_price" value="Update"/>
			</form>
		</center>
    </body>
</html>