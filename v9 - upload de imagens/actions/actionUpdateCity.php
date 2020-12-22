<?php
	//Action Update City v5
	
	session_start();
	
	include_once "../includes/opendb.php";
	include_once "../database/city.php";
	
	if (!empty($_GET['Cancelar'])) {
		//Se cancelou, redireciona de imediato para a página de entrada
		header("Location: ../pages/listCities.php");
	}
	if (!empty($_GET['Confirmar'])) {
		//Se confirmou, recupera os valores introduzidos pelo utilizador no formulário e passados pelo link
		$id_cidade = $_GET['id'];
		$nome = $_GET['nome'];
		$pais = $_GET['pais'];
		$populacao = $_GET['populacao'];
		$temperatura = $_GET['temperatura'];
	
		//Validação dos dados
		//Assume-se que todos os campos são obrigatórios (a query insert apenas é executada se todos os campos  preenchidos)
		if (empty($id_cidade) || empty($nome) || empty($pais) || empty($populacao) ||  empty($temperatura)){
			//Nota: || é o operador OU em PHP 
			$dadosValidos = false;
			}
		else {
			$dadosValidos = true;
		}
		
		//********* 2. Executar a query e redirecionar para a página de apresentação

		if (!$dadosValidos){
			//Nota: ! é o operador NOT em PHP
			//Se dados não válidos, é gerada e guardada uma mensagem de erro em variável de sessão
			$_SESSION['msgErro'] = "Erro no formulário (pelo menos um dos campos em falta)<p>";
			
			//Também são registados em variáveis de sessão os dados introduzidos pelo utilizador no formulário, bem como o id da cidade
			$_SESSION['id'] = $id_cidade;
			$_SESSION['nome'] = $nome;
			$_SESSION['pais'] = $pais;
			$_SESSION['populacao'] = $populacao;
			$_SESSION['temperatura'] = $temperatura;
			
			//Depois de criadas as variáveis de sessão, o script é redirecionado para o formulário que irá apresentar os dados que o utilizador tinha introduzido anteriormente 			
			header("Location: ../pages/formCreateCity.php");
		}	
		else {
			//Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada	
			$result = updateCity($id_cidade, $nome, $pais, $populacao, $temperatura);
			header("Location: ../pages/listCities.php");
		}

		
	}
?>



