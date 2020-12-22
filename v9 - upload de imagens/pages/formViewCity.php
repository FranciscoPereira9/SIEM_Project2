<?php
	//Form View City v5
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location: login.php");}
	include_once "../includes/opendb.php";
	include_once "../database/city.php";
?>
<html>
	<?php
		include_once "components/header.php";
	 ?>
<h3>Ver detalhes da cidade selecionada</h3>
<?php

	$id_cidade = $_GET['id'];
	//echo "id: ".$id_cidade."<p>";

	//Obter dados da cidade
	$result = getCityById($id_cidade);

	$row = pg_fetch_assoc($result);

	echo "Nome: <input type=\"text\" 		name=\"nome\" 		 value=\"".$row['name'].		"\" disabled><br>";
	echo "País: <input type=\"text\" 		name=\"pais\" 		 value=\"".$row['country'].		"\" disabled><br>";
	echo "População: <input type=\"text\" 	name=\"populacao\"	 value=\"".$row['inhabitants'].	"\" disabled><br>";
	echo "Temperatura: <input type=\"text\" name=\"temperatura\" value=\"".$row['temperature'].	"\" disabled><br>";
	if(!empty($row['image']))
		echo "<img src=\"../images/".$row['image']."\" width=\"200\" >";
?>

<p><a href = "listCities.php">Voltar à página inicial</a></p>

</body>
</html>
