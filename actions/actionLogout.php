<?php
    session_start();
	$_SESSION['username']='';
	$_SESSION['email'] = '';
	echo $_SESSION['username'];
	
	header("Location: ../pages/user.php");
?>