<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Database Admin")
		echo '<script>window.location.href="index.php";</script>';
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Database Admin Dashboard</title>
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
		
		<center>
			<h1>Database Admin Dashboard</h1>
			
			
			<form method=POST action="manage_company_admin.php">
				<input type=submit value="Manage Company">
			</form>
			
			<br>
			
			<form method=POST action="manage_client.php">
				<input type=submit value="Manage Client">
			</form>
			
			<br>
			
			<form method=POST action="view_tree_by_date.php">
				<input type=submit value="View All Tree">
			</form>
		</center>
    </body>
</html>