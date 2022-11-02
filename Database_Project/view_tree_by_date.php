<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Database Admin")
		echo '<script>window.location.href="index.php";</script>';
	
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>All Tree</title>
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
		<a style="padding-left:20px;" href="database_admin_dashboard.php">Back</a>
			
		<center>
			<h1>Tree Record</h1>
			
			<br/>
			
			<form method=POST action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<select name="date">
							<option value="">--Select date planted--</option>
					<?php 
						$sel_dateplanted = mysqli_query($db, "SELECT DatePlanted FROM tree GROUP BY DatePlanted");
						while($sel = mysqli_fetch_assoc($sel_dateplanted)) { 
							$date_option = $sel['DatePlanted'];
					?>
							<option value="<?php echo $date_option; ?>"><?php echo $date_option; ?></option>
					<?php } ?>
				</select>
				<input type=submit name="set_date" value="Set Date"/>
			</form>
			
			<?php
				
				if(!isset($_POST['set_date']) OR empty($_POST['date'])) {
					$sel_all_tree = "SELECT * FROM tree";
					$show_date = "All Date";
				}
				else {
					$dateplanted = mysqli_fetch_assoc(mysqli_query($db, "SELECT DatePlanted FROM tree WHERE DatePlanted='".$_POST['date']."' "));
					$date = $dateplanted['DatePlanted'];
					$sel_all_tree = "SELECT * FROM tree WHERE DatePlanted='$date'";
					$show_date = $_POST['date'];
				}
			?>
			
			<br/>
			<h2>Date Planted: <?php echo $show_date; ?></h2>
			<br/>
			
			<table>
				<tr>
					<td>No.</td>
					<td>Tree Name</td>
					<td>Diameter</td>
					<td>Height</td>
					<td>Status</td>
					<td>Date Planted</td>
					<td>Block No</td>
				</tr>
				<?php 
					$no=1;
					
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
				</tr>
				<?php $no++;} ?>
			</table>
		</center>
    </body>
</html>