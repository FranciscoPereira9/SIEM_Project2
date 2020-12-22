<?php
	//Form Delete City v5
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

<h3>Eliminar a cidade selecionada</h3>

<?php

	$id_cidade = $_GET['id'];

	//Obter dados da cidade
	$result = getCityById($id_cidade);
	$row = pg_fetch_assoc($result);

	//Apresentar os dados da cidade em formulário
	echo "<form method = \"GET\" action = \"../actions/actionDeleteCity.php\">";

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
