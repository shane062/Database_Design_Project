<?php 
    require 'server.php';
	
	if($_SESSION["user"] != "Staff") {}
	//echo '<script>window.location.href="index.php";</script>';
   
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Manage Tree Record</title>
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
		<ul>
			<li>
				<a href="staff_dashboard.php?logout_button=">Log Out</a>
			</li>
		</ul>     
		<center>
			<br>
			<div class="home-wrapper">
				<div class="wrapper">
					<div class="home-box-wrap">
						
						<article class="home-box">
							<h2>Record Trees</h2>
							<div class="home-overlay">
								<form action="record_tree.php">
									<input type="hidden" name="service_id" value=""> 
									<input type="submit" name="record_tree" value="Record Trees">
								</form>
							</div>
						</article>

					</div>
				</div>
			</div>

		</center>
    </body>
</html>