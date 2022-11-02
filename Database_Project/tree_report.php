<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Company Admin")
		echo '<script>window.location.href="index.php";</script>';
	
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Company Tree Info</title>
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
		<a style="padding-left:20px;" href="company_admin_dashboard.php">Back</a>
		
		<center>
			<h1>Company Tree Info</h1>
			
			<br/>
			<table>
				<tr>
					<td>No.</td>
					<td>Tree Name</td>
					<td>Diameter</td>
					<td>Height</td>
					<td>Status</td>
					<td>Block No</td>
				</tr>
				<?php $no=1;
					$sel_all_tree = "SELECT * FROM tree WHERE BlockID IN(SELECT BlockID FROM block WHERE OrchardID IN(SELECT OrchardID FROM orchard WHERE AdminID='".$_SESSION["adminid"]."'))";
					$all_tree_list = mysqli_query($db, $sel_all_tree);
					while($query = mysqli_fetch_array($all_tree_list)) {
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $query['TreeName']; ?></td>
					<td><?php echo $query['TreeDiameter']; ?></td>
					<td><?php echo $query['TreeHeight']; ?></td>
					<td><?php echo $query['TreeStatus']; ?></td>
					<td><?php echo $query['BlockID']; ?></td>
				</tr>
				<?php $no++;} ?>
			</table>
		</center>
    </body>
</html>