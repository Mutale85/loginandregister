<?php 
	include("db.php");
	if(isset($_SESSION['username'])){
		header("location:./");
	}
	
	$output = "";
	if(isset($_POST['username'])){
		$username = Clean(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS));
		$email = Clean(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS));
		$password = Clean(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS));


		if(strlen($username) < 3){
			$output = ' Username cannot be less than 3 characters'; 
		}

		if(strlen($password) < 5){
			$output = ' password cannot be less than 5 characters'; 
		}

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$output = ' Invalid Email';
		}

		// check if user is alaready registered
		$query = $connect->prepare("SELECT * FROM users_table WHERE email = ? ");
		$query->execute(array($email));
		$count = $query->rowCount();

		if($count > 0){
			$output = "User with email: ". $email. " is already registered";
		}else{
			// register user
			$sql = $connect->prepare("INSERT INTO users_table(username, email, password) VALUES(?, ?, ?)");
			$pass = password_hash($password, PASSWORD_DEFAULT);
			$ex = $sql->execute(array($username, $email, $pass));
			if($ex){
				$output = $username . " registered succefully";
			}else{
				$output = "Error occured";
			}
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
		<h1>Mulscoding Registration Form</h1>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" class="form">
			<label>Create Username</label>
			<input type="text" name="username" id="username" required>
			
			<label>Your Email</label>
			<input type="email" name="email" id="email" required>

			<label>Create Password</label>
			<input type="password" name="password" id="password" required>

			<button type="submit" name="submit" class="button">Submit</button>
			<p><a href="login.php">Already a member? Login</a></p>

			<p><?php echo $output;?></p>
		</form>

	</div>
</body>
</html>