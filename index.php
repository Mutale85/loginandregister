<?php 
	include("db.php");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login and register</title>
	<style type="text/css">
		body {
			background: aliceblue;
		}
		a:active, a:link {
			text-decoration: none;
		}
	</style>
</head>
<body>
	
	<?php 
		if(isset($_SESSION['username'])){
			echo "<h1>Welcome ". $_SESSION['username']."</h1>";
			echo '<p><a href="logout.php">Logout</a></p>';
		}else{?>

			<h1>Register and Login template</h1>
			<a href="register.php">Register</a>
			<a href="login.php">Login</a>
	<?php		
		}
	?>
	<!-- 
		Done-- Create a registration form
		Done-- Create a login form
		Done-- Create a Database
		Done -- Connect to Database
		Done -- Submit Client
		Done -- Login Client
		Done -- Logout Client
	-->
</body>
</html>