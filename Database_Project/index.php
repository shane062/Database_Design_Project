<?php require 'server.php'; ?>
<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<title> Tree Profiling </title>
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
		<center>
			<br>
			<h1> Login </h1>
			<form name="login_form" method="post" action="index.php">
				<table>
					<tr>
						<td>
							Role:
						</td>
						<td>
							<select name="role"/>
								<option value="">Select Role</option>
								<option value="Database Admin">Database Admin</option>
								<option value="Company Admin">Company</option>
								<option value="Worker">Worker</option>
								<option value="Client">Client</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							Login ID:
						</td>
						<td>
							<input autocomplete=off name="userloginid" type="text">
						</td>
					</tr>
					<tr>
						<td>
							Password:
						</td>
						<td>
							<input name="password" type="password">
						</td>
					</tr>
				</table>
				<input type="submit" name="login_button" value="Log In">
			</form>
			
			<br/>
			
			<form method=POST action="register.php">
				Want to buy blocks of tree?
				<input type=submit value="Create an account" />
			</form>
		</center>
	</body>
</html>