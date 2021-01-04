<?php
	include_once "../includes/opendb.php";
	
	global $conn;
	
	if(isset($_POST['img'])){
		echo $_POST['img'];
		$path = "../images/products/Homem/Calças/".$_POST['img'];
		$img = fopen($path, 'r')  or die("cannot read image\n");
		$data = fread($img, filesize($path));
		
		$es_data = pg_escape_bytea($data);
		fclose($img);

		$query = "UPDATE \"tp_php\".products set img='$es_data' where sku=2;";
		pg_query($conn, $query); 

		pg_close($conn);

	}
	
?>

<form method="POST" action="img_test.php">
	<input type="file" name="img">
	<input type="submit" name="submit">
</form>