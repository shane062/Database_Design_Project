<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Client")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['buy_block'])) {
		$clientid = $_SESSION['clientid'];
		$blockid = $_POST['blockid'];
		$date = date("Y-m-d H:i:s");
		
		$add_payment = "INSERT INTO client_block (ClientID,BlockID,PaymentDate) VALUES ('$clientid', '$blockid','$date')";
		$add_payment_history = "INSERT INTO client_block_history (ClientID,BlockID,PaymentDate) VALUES ('$clientid', '$blockid','$date')";
		
		mysqli_query($db, $add_payment) or die(mysqli_error($db));
		mysqli_query($db, $add_payment_history) or die(mysqli_error($db));
		echo '<script>alert("You own the block now!");</script>';
		echo '<script>window.location.href="client_dashboard.php";</script>';
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Buy New Block</title>
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
			
			function confirmBuy() {
				return confirm("Confirm?");
			}
        </script>
		<a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout_button=">
			Log Out
		</a>
		<a style="padding-left:20px;" href="client_dashboard.php">Back</a>
		<center>
			<h2>Buy New Block</h2>
		
			<table>
				<tr>
					<td>Block ID</td>
					<td>Block Price (RM)</td>
					<td>Orchard</td>
					<td>Company</td>
					<td>No. Of Tree</td>
				</tr>
				<?php	
					$block = mysqli_query($db, "SELECT * FROM block WHERE BlockID NOT IN(SELECT BlockID FROM client_block) ");
					
					while($query_block = mysqli_fetch_array($block)) {
						$search_orchard = "SELECT * FROM orchard WHERE OrchardID IN(SELECT OrchardID FROM block WHERE BlockID='".$query_block['BlockID']."') ";
						$orchard = mysqli_fetch_array(mysqli_query($db, $search_orchard));
						
						$search_company = "SELECT CompanyName FROM company_admin WHERE AdminID IN(SELECT AdminID FROM orchard WHERE OrchardID='".$orchard['OrchardID']."') ";
						$company = mysqli_fetch_array(mysqli_query($db, $search_company));
						
						$count_tree = "SELECT COUNT(TreeID) AS tree_amount FROM tree WHERE BlockID='".$query_block['BlockID']."' ";
						$tree = mysqli_fetch_array(mysqli_query($db, $count_tree));
				?>
				<tr>
					<td><?php echo $query_block['BlockID']; ?></td>
					<td><?php echo $query_block['BlockPrice']; ?></td>
					<td><?php echo $orchard['OrchardName']; ?></td>
					<td><?php echo $company['CompanyName']; ?></td>
					<td><?php echo $tree['tree_amount']; ?></td>
					<td>
						<form method=POST action="view_block_tree.php">
							<input type=hidden name="blockid" value="<?php echo $query_block['BlockID']; ?>"/>
							<input type=hidden name="orchardname" value="<?php echo $orchard['OrchardName']; ?>"/>
							<input type=hidden name="companyname" value="<?php echo $company['CompanyName']; ?>"/>
							<input type=submit value="View Tree"/>
						</form>
					</td>
					<td>
						<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<input type=hidden name="blockid" value="<?php echo $query_block['BlockID']; ?>"/>
							<input type=submit name="buy_block" value="Buy Block" onclick="return confirmBuy()"/>
						</form>
					</td>
				</tr>
				<?php } ?>
			</table>
		</center>
    </body>
</html>