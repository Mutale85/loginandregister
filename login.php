<?php
	include("db.php");
	if(isset($_SESSION['username'])){
		header("location:./");
	}
	
	$output = "";
	if(isset($_POST['email'])){
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$password = Clean(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$output = ' Invalid Email';
		}

		// check if user is already registered
		$query = $connect->prepare("SELECT * FROM users_table WHERE email = ? ");
		$query->execute(array($email));
		$count = $query->rowCount();
		if($count > 0){
			foreach ($query->fetchAll() as $row) {
				if(password_verify($password, $row['password'])){
					// login user
					$_SESSION['username'] = $row['username'];
					$_SESSION['email'] = $row['email'];
					header("location:./");
				}else{
					$output = 'Invalid password or email';
				}
			}
		}else{
			$output = "user not found in our system";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<style>
		.registerDIv {
			margin: 5em auto;
			width: 45%;

		}
		.form {
			border: 1px solid #dedede;
			padding: 2em;
		}
		input {
			display: block;
			width: 100%;
			margin: .8em auto;
			padding: .5em;
		}
		.button {
			border: none;
			outline: none;
			background: #6499cd;
			padding: .6em 1em;
			font-size: 1em;
			border-radius: 5px;
			color: #fff;
		}
		a:active, a:link {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div class="registerDIv">
		<h1>Mulscoding Login Form</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" class="form">
			
			<label>Email</label>
			<input type="email" name="email" id="email" required>

			<label>Password</label>
			<input type="password" name="password" id="password" required>

			<button type="submit" name="submit" class="button">Submit</button>
			<p><a href="register.php">Not a member? Register</a></p>

			<p><?php echo $output?></p>
		</form>

	</div>
</body>
</html>