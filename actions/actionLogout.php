<?php
    session_start();
	$_SESSION['username']=NULL;
	$_SESSION['email'] =NULL;
	echo $_SESSION['username'];
	
	header("Location: ../pages/user.php");
?>