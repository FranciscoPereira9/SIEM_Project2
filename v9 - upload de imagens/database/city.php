<?PHP

	function getAllCities($city, $countries){
		global $conn;
		$query = "select * from cities where 1=1";
		if($city)	{
			$query .= " AND name like '$city'";
		}

		if(!empty($countries) && sizeof($countries) > 0){
			$query .= " AND ";

			for($i=0; $i < sizeof($countries);$i++){
					if($i>0){
					$query .= " OR ";
					}
					$query .= "country = '". $countries[$i]."'";
			}
		}
		$query .= " order by country;";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function getCityById($id) {
		global $conn;
		$query = "select * from cities where id=".$id.";";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function createCity($nome, $pais, $populacao, $temperatura, $image) {
		global $conn;

		$query = "insert into cities
				  (name, country, inhabitants, temperature, image)
				  values ('".$nome."', '".$pais."', '".$populacao."' ,'".$temperatura."', '". $image ."');";

		$result = pg_exec($conn, $query);
				return $query;
	}

	function updateCity($id_cidade, $nome, $pais, $populacao, $temperatura) {
		global $conn;

		//$query = "update cities set name = 'porto', country = 'pt', inhabitants = '10', temperature = '34' where id =5;";

		$query = "update cities
				  set name = '".$nome."',
				      country = '".$pais."',
					  inhabitants = '".$populacao."',
					  temperature = '".$temperatura."'
				  where id =".$id_cidade.";";

		$result = pg_exec($conn, $query);
		return $result;
		}

	function deleteCity($id){
		global $conn;
		$query = "delete from cities where id=".$id.";";
		$result = pg_exec($conn, $query);
		return $result;
	}

	function getAllCountries(){
		global $conn;
		$query = "select country from cities group by country;";
		$result = pg_exec($conn, $query);
		return $result;
	}



?>
