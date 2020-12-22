<?php
	//Action Delete City v5
	
	include_once "../includes/opendb.php";
	include_once "../database/city.php";

	//**********  1. Tratar os dados de entrada	
	if (isset($_GET['Cancelar'])) {
		//Se cancelou, redireciona de imediato para a página de entrada
		header("Location: ../pages/listCities.php");
	}
	else {
		//Se não cancelou, recupera o id da cidade selecionada, executa a query após o que redireciona para a página de entrada
		$id_cidade = $_GET['id'];
		$result = deleteCity($id_cidade);
		header("Location: ../pages/listCities.php");
	}
?>
