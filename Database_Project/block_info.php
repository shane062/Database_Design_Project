<?php 
    require 'server.php';

    if($_SESSION["user"] != "Client")
        echo '<script>window.location.href="index.php";</script>';
	
	if(isset($_POST['blockid']))
		$blockid = $_POST['blockid'];
	else {
		echo "<script>window.history.back();</script>";
	}
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Block Info</title>
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
		<a style="padding-left:20px;" href="client_dashboard.php">Back</a>
		<center>
			<h1>Block Info</h1>
			
			<?php $no=1;
				$search_price = "SELECT BlockPrice FROM block WHERE BlockID = '$blockid' ";
				$price = mysqli_fetch_array(mysqli_query($db ,$search_price));
				
				$search_orchard = "SELECT * FROM orchard WHERE OrchardID IN(SELECT OrchardID FROM block WHERE BlockID = '$blockid') ";
				$orchard = mysqli_fetch_array(mysqli_query($db, $search_orchard));
				
				$search_company = "SELECT CompanyName FROM company_admin WHERE AdminID IN(SELECT AdminID FROM orchard WHERE OrchardID = '".$orchard['OrchardID']."' ) ";
				$company = mysqli_fetch_array(mysqli_query($db, $search_company));
			?>
			
			<table>
				<tr>
					<td>Block ID:</td>
					<td><?php echo $blockid; ?></td>
				</tr>
				<tr>
					<td>Price:</td>
					<td><?php echo 'RM '.$price['BlockPrice']; ?></td>
				</tr>
				<tr>
					<td>From Orchard:</td>
					<td><?php echo $orchard['OrchardName']; ?></td>
				</tr>
				<tr>
					<td>Orchard Address:</td>
					<td><?php echo $orchard['OrchardAddress']; ?></td>
				</tr>
				<tr>
					<td>From Company:</td>
					<td><?php echo $company['CompanyName']; ?></td>
				</tr>
			</table>
			
			<br/>
			
			<table>
				<tr>
					<td>No.</td>
					<td>Tree Name:</td>
					<td>Height:</td>
					<td>Diameter:</td>
				</tr>
				<?php $no=1;
					$search_tree = "SELECT * FROM tree WHERE BlockID = '$blockid' ";
					$query_tree = mysqli_query($db ,$search_tree) or die(mysqli_error($db));
					while($tree = mysqli_fetch_array($query_tree)) {
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $tree['TreeName']; ?></td>
					<td><?php echo $tree['TreeHeight']; ?></td>
					<td><?php echo $tree['TreeDiameter']; ?></td>
				</tr>
				<?php $no++; } ?>
			</table>
			
		</center>
    </body>
</html>