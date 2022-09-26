<?php
	include("db.php");
	unset($_SESSION['username']);
	unset($_SESSION['email']);
	if(session_destroy()){
		header("location:./");
	}
?>