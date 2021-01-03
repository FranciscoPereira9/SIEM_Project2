<?php

//TODO: por parâmetros para outros campos(marca, ean, cor...)
function getAllProducts($product){
	
	global $conn;
	$query = "select * from \"tp_php\".products where 1=1";
	if(!empty($product)){
		$query .= "AND name = '$product' OR color='$product' OR ean='$product' OR brand='$product'";
	}
	$query .= "ORDER BY sku ASC";
	$result = pg_exec($conn, $query);
	return $result;
	
}

function getPrice($product_ean){
	global $conn;
	
	$query = "select price from \"tp_php\".products where ean='".$product_ean."';";
	
	$result = pg_exec($conn, $query);
	$price = pg_fetch_assoc($result)['price'];
	
	return $price;
}

function getProductName($product_ean){
	global $conn;
	
	$query = "select name from \"tp_php\".products where ean='".$product_ean."';";
	
	$result = pg_exec($conn, $query);
	
	$name = pg_fetch_assoc($result)['name'];

	return $name;
}

?>