<?php
	session_start();
	include_once "../includes/opendb.php";
	include_once "../database/city.php";
?>
<html>
<?php
	include_once "components/header.php";
 ?>
<h3>Listagem de todas as cidades em base de dados</h3>
<?php
		$city = "";
		$countriesSelected = [];
	//variáveis onde são guardados os dados da pesquisa
		if(isset($_GET['city'])){
			$city = $_GET['city'];
		}

		if(isset($_GET['countryArray'])){
			$countriesSelected = $_GET['countryArray'];
	}

	// Obtenção da lista de todas as cidades da BD
	$cities = getAllCities($city, $countriesSelected);
	//Obtenção de todos os país listados na BD
	$countries =  getAllCountries();

?>
	<!-- Formulário de pesquisa-->
	<h4> Pesquisa </h4>
	<form id="search-form" method="get" action="listCities.php">
			<p><label for="City">City:</label><input type="text" name="city"/ value="<?php if(!empty($city)){echo $city;} ?>"> </p>
			<?php
				//listar os país para serem aprentados na pesquisa
				for($i=0; $i < pg_numrows($countries); $i++)
				{
					$row = pg_fetch_row($countries, $i);
					$checkboxElement = "<label for='$row[0]'>$row[0]:</label><input type='checkbox' name='countryArray[]' value='".$row[0]."'";
					//garantir que os valores passados na pesquisa anterior continuam visíveis
					if(!empty($countriesSelected)){
						for($j=0; $j<sizeof($countriesSelected); $j++){
							if($row[0] == $countriesSelected[$j]){
								$checkboxElement .= " checked ";}
							}
					}
					$checkboxElement .= ">";
				  echo $checkboxElement;
				}
				?>
			<p><input type="submit" value="Pesquisar" /> </p>
	</form>

<?php

	if(pg_numrows($cities)>0){
	// Geração do HTML (tabela com a lista das cidades
	echo "<table>";
	echo "<tr>";
	echo "<th>Cidade</th><th>País</th><th>Habitantes</th> <th>Temperatura</th>";
	//Apenas adicionas as colunas Eliminar e Editar quando tem um login válido
	if(isset($_SESSION['username'])){
		echo "<th width=60></th><th width=60></th>";
	};
	echo "</tr>";

	$row = pg_fetch_assoc($cities);

	while (isset($row["id"])) {
		echo "<tr>";
			echo "<td><a href=\"formViewCity.php?id=".$row['id']."\">".$row['name']."</a></td>";

			echo "<td>".$row['country']."</td>";
			echo "<td>".$row['inhabitants']."</td>";
			echo "<td>".$row['temperature']."</td>";
			//Apenas adicionas as colunas Eliminar e Editar quando tem um login válido
			if(isset($_SESSION['username'])){
			echo "<td><a href=\"formUpdateCity.php?id=".$row['id']."\">Editar</a></td>";
			echo "<td><a href=\"formDeleteCity.php?id=".$row['id']."\">Eliminar</a></td>";
		}
		echo "</tr>";

		$row = pg_fetch_assoc($cities);
	}
	echo "</table>";
	}
	else {
		echo "<p>Não existem resultados.</p>";
	}

	echo "<p><a href=\"formCreateCity.php\">Nova cidade</a></td></p>";

?>

</body>
</html>
