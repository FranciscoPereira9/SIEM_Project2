<?php
	//Action Create City v5
	session_start();

	include_once "../includes/opendb.php";
	include_once "../database/city.php";


	//**********  1. Tratar os dados de entrada
	if (!empty($_POST['Cancelar'])) {
		//Se cancelou, redireciona de imediato para a página de entrada
		header("Location: ../pages/listCities.php");
	}
	if (!empty($_POST['Confirmar'])) {
		//Se comfirmou, recupera os valores introduzidos pelo utilizador no formulário e passados pelo link

		$nome = $_POST['nome'];
		$pais = $_POST['pais'];
		$populacao = $_POST['populacao'];
		$temperatura = $_POST['temperatura'];

		//Validação dos dados
		//Assume-se que todos os campos são obrigatórios (a query insert apenas é executada se todos os campos  preenchidos)
		if (empty($nome) || empty($pais) || empty($populacao) ||  empty($temperatura)){
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

			//Também são registados em variáveis de sessão os dados introduzidos pelo utilizador no formulário
			$_SESSION['nome'] = $nome;
			$_SESSION['pais'] = $pais;
			$_SESSION['populacao'] = $populacao;
			$_SESSION['temperatura'] = $temperatura;

			//Depois de criadas as variáveis de sessão, o script é redirecionado para o formulário que irá apresentar os dados que o utilizador tinha introduzido anteriormente
			header("Location: ../pages/formCreateCity.php");
		}
		else {
			$fileName = "";
			if (isset($_FILES["file"]["error"]) && $_FILES["file"]["error"] > 0)
				{
					echo "Error: " . $_FILES["file"]["error"] . "<br>";
				}
				else
				{
					$prefixo = '123_'; // definir um prefixo apropriado para identificação
					$fileName = $prefixo . $_FILES["file"]["name"];
					$fileName = str_replace(' ', '', $fileName);//remover os espaços para evitar erros
					$destino = '../images/' . $fileName; 
					move_uploaded_file($_FILES["file"]["tmp_name"], $destino);
					}
					//Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada
					$result = createCity($nome, $pais, $populacao, $temperatura,$fileName);

			header("Location: ../pages/listCities.php");
		}
	}

?>
