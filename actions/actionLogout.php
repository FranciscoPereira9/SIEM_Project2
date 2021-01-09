<?php
    session_start();
	
	//LIBERTA VARIÁVEIS DE SESSÃO, QUE É EQUIVALENTE A DAR LOGOUT
	$_SESSION['username']=NULL;
	$_SESSION['email'] =NULL;
	
	header("Location: ../pages/user.php");
?>