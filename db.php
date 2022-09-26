<?php 
	session_start();
	session_name();
	$connect = new PDO("mysql:host=localhost;dbname=login_register;", "root", "");
	if($connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION)){
		// echo "Connection to DB successful";
	}

	ini_set('pcre.jit', '0');

	function Clean($s){
		return htmlspecialchars($s);
		return trim($s);
	}


?>