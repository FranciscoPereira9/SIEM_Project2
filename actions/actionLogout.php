<?php
    session_start();
	$_SESSION['username']='';
	echo $_SESSION['username'];
	
	header("Location: ../pages/user.php");
?>