<?php
	session_start();
	include_once "../includes/opendb.php";
	include_once "../database/db_user.php";
	
	echo $_SESSION['email'];
	$details = getUserDetails($_SESSION['email']);
	print_r($details);

	
	
?>
