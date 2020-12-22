<?php
	//Form Update City v5
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: login.php");
	}
	include_once "../includes/opendb.php";
	include_once "../database/city.php";
?>
<html>
	<?php
		include_once "components/header.php";
	 ?>
<h3>Editar a cidade selecionada</h3>

<?php

	if (!empty($_SESSION['msgErro'])) {
		//Se houver uma msg de erro: apresenta essa msg, recupera os valor dos campos e, no final, limpa as variáveis de sessão
		echo "<p style=\"color:red\">".$_SESSION['msgErro']."<p>";
		$_SESSION['msgErro'] = NULL;

		//Recuperar os campos do formulário guardados na variáveis de sessão, e depois limpar essas variáveis
		$id_cidade = $_SESSION['id'];
		if (!empty($_SESSION['nome'])) 		 	$nome = $_SESSION['nome']; 					else $nome = "";
		if (!empty($_SESSION['pais'])) 		 	$pais = $_SESSION['pais']; 					else $pais = "";
		if (!empty($_SESSION['populacao'])) 	$populacao = $_SESSION['populacao']; 		else $populacao = "";
		if (!empty($_SESSION['temperatura'])) 	$temperatura = $_SESSION['temperatura']; 	else $temperatura = "";

		$_SESSION['id'] = NULL;
		$_SESSION['nome'] = NULL;
		$_SESSION['pais'] = NULL;
		$_SESSION['populacao'] = NULL;
		$_SESSION['temperatura'] = NULL;
	}
	else {
		//No caso de não chegar ao script na sequência de um erro, é porque se trata do 1º acesso e então os dados
		//são obtidos a partir da bdd, sendo o id passado no link
		$id_cidade = $_GET['id'];
		$result = getCityById($id_cidade);
		$row = pg_fetch_assoc($result);
	}

	//Apresentar os dados da cidade em formulário
	echo "<form method = \"GET\" action = \"../actions/actionUpdateCity.php\">";

		echo "<input type=\"hidden\" 			name=\"id\" 		 value=\"".$id_cidade."\"><br>";
		echo "Nome: <input type=\"text\" 		name=\"nome\" 		 value=\"".$row['name']."\"><br>";
		echo "País: <input type=\"text\" 		name=\"pais\" 		 value=\"".$row['country']."\"><br>";
		echo "População: <input type=\"text\" 	name=\"populacao\"	 value=\"".$row['inhabitants']."\"><br>";
		echo "Temperatura: <input type=\"text\" name=\"temperatura\" value=\"".$row['temperature']."\"><br>";

		echo "<p align=\"left\">
			  <input type=\"submit\" 	name=\"Confirmar\" 	value=\"Confirmar\">
			  <input type=\"submit\" 	name=\"Cancelar\"	value=\"Cancelar\">";

	echo "</form>";

?>

</body>
</html>
