<?php

//TODO: por parâmetros para outros campos(marca, ean, cor...)
function getAllProducts($product){
	
	global $conn;
	$query = "select * from \"tp_php\".products where 1=1";
	if(!empty($product)){
		$query .= "AND name = '$city'";
	}
	$result = pg_exec($conn, $query);
	return $result;
	
}

function getPrice($product_sku){
	global $conn;
	
	$query = "select price from \"tp_php\".products where sku=".$product_sku.";";
	
	$result = pg_exec($conn, $query);
	$price = pg_fetch_assoc($result)['price'];
	
	return $price;
}

function getProductName($product_sku){
	global $conn;
	
	$query = "select name from \"tp_php\".products where sku=".$product_sku.";";
	
	$result = pg_exec($conn, $query);
	
	$name = pg_fetch_assoc($result)['name'];

	return $name;
}

?>