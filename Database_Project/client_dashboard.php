<?php 
    require 'server.php';

    if($_SESSION["user"] != "Client")
        echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['blockid'])) {
		$blockid = $_POST['blockid'];
		$delete = "DELETE FROM client_block WHERE BlockID='$blockid'";
		mysqli_query($db, $delete);
		echo '<script>alert("Block refunded");</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Client Dashboard</title>
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
		
		<center>
			<h1>Client Dashboard</h1>
			<br/>
			
			<h3>Block Of Tree Owned</h3>
			<form method=POST action="buy_block.php">
				<input type=submit value="Buy new block"/>
			</form>
			<br/>
			
			<?php
					$search_payment = "SELECT * FROM client_block WHERE ClientID = '".$_SESSION['clientid']."' ";
					$result = mysqli_query($db ,$search_payment) or die(mysqli_error($db));
					$query = mysqli_fetch_array($result);
					
					if($query == null) {
						echo "You have not made any purchases";
					}
					
					else {
				?>
			<table>
				<tr>
					<td>Block ID</td>
					<td>Price (RM)</td>
					<td>Payment Date & Time</td>
				</tr>
				<?php 
					$result = mysqli_query($db ,$search_payment) or die(mysqli_error($db));
					
					while($query = mysqli_fetch_array($result)) {
						$search_price = "SELECT BlockPrice FROM block WHERE BlockID = '".$query['BlockID']."' ";
						$price = mysqli_fetch_array(mysqli_query($db ,$search_price));
				?>
				<tr>
					<td><?php echo $query['BlockID']; ?></td>
					<td><?php echo $price['BlockPrice']; ?></td>
					<td><?php echo $query['PaymentDate']; ?></td>
					<td>
						<form method=POST action="block_info.php">
							<input type=hidden name="blockid" value="<?php echo $query['BlockID']; ?>"/>
							<input type=submit value="View block info"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type=hidden name="blockid" value="<?php echo $query['BlockID']; ?>"/>
							<input type=submit name="refund" value="Refund" onclick="return confirmDel()"/>
						</form>
					</td>
				</tr>
					<?php }} ?>
			</table>
		</center>
    </body>
</html>