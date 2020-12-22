<?php
	//Form Create City v5
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
<h3>Criar nova cidade</h3>

<?php

	//Se houver uma msg de erro na variável de sessão, apresenta-a e depois limpa a variável
	if (!empty($_SESSION['msgErro'])) {
		echo "<p style=\"color:red\">".$_SESSION['msgErro']."<p>";
		$_SESSION['msgErro'] = NULL;
	}

	//Recuperar os campos do formulário guardados na variáveis de sessão, e depois limpar essas variáveis
	if (!empty($_SESSION['nome'])) 		 	$nome = $_SESSION['nome']; 					else $nome = "";
	if (!empty($_SESSION['pais'])) 		 	$pais = $_SESSION['pais']; 					else $pais = "";
	if (!empty($_SESSION['populacao'])) 	$populacao = $_SESSION['populacao']; 		else $populacao = "";
	if (!empty($_SESSION['temperatura'])) 	$temperatura = $_SESSION['temperatura']; 	else $temperatura = "";

	$_SESSION['nome'] = NULL;
	$_SESSION['pais'] = NULL;
	$_SESSION['populacao'] = NULL;
	$_SESSION['temperatura'] = NULL;


	//Apresentar o formulário com os campos vazios no 1ª acesso, ou pré-prenchidos com os valores recuperados através das variáveis de sessão no caso de ter havido um erro
	echo "<form method = \"POST\" action = \"../actions/actionCreateCity.php\" enctype=\"multipart/form-data\">";

		echo "Nome: <input type=\"text\" 		name=\"nome\" 		 value=\"".$nome."\"><br>";
		echo "País: <input type=\"text\" 		name=\"pais\" 		 value=\"".$pais."\"><br>";
		echo "População: <input type=\"text\" 	name=\"populacao\"	 value=\"".$populacao."\"><br>";
		echo "Temperatura: <input type=\"text\" name=\"temperatura\" value=\"".$temperatura."\"><br>";
		echo "Imagem: <input type=\"file\" name=\"file\" id=\"file\" >";


		echo "<p align=\"left\">
			  <input type=\"submit\" 	name=\"Confirmar\" 	value=\"Confirmar\">
			  <input type=\"submit\" 	name=\"Cancelar\"	value=\"Cancelar\">
				";


	echo "</form>";

?>

</body>
</html>
