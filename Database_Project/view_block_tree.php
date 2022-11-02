<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Client")
		echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['blockid'])) {
		$blockid = $_POST['blockid'];
		$orchardname = $_POST['orchardname'];
		$companyname = $_POST['companyname'];
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Tree of Block</title>
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
		<a style="padding-left:20px;" href="buy_block.php">Back</a>
		
		<center>
			<h2>Tree of Block</h2>
			
			<table>
				<tr>
					<td>Block ID:</td>
					<td><?php echo $blockid; ?></td>
				</tr>
				<tr>
					<td>Orchard:</td>
					<td><?php echo $orchardname; ?></td>
				</tr>
				<tr>
					<td>Company:</td>
					<td><?php echo $companyname; ?></td>
				</tr>
			<table>
			
			<br/>
			
			<table>
				<tr>
					<td>Tree Name</td>
					<td>Height</td>
					<td>Diameter</td>
					<td>Status</td>
					<td>Date Planted</td>
				</tr>
				<?php	
					$search_tree = mysqli_query($db, "SELECT * FROM tree WHERE BlockID='$blockid' ");
					
					while($tree = mysqli_fetch_array($search_tree)) {
				?>
				<tr>
					<td><?php echo $tree['TreeName']; ?></td>
					<td><?php echo $tree['TreeHeight']; ?></td>
					<td><?php echo $tree['TreeDiameter']; ?></td>
					<td><?php echo $tree['TreeStatus']; ?></td>
					<td><?php echo $tree['DatePlanted']; ?></td>
				</tr>
				<?php } ?>
			</table>
		</center>
    </body>
</html>