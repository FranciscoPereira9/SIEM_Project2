<?php


function get_sku($ean, $color){
	global $conn;
	
	$query = "select sku from \"tp_php\".products where ean='".$ean."' and LOWER(color)=LOWER('".$color."');";
	
	$result = pg_exec($conn, $query);
	$sku = pg_fetch_assoc($result)['sku'];
	
	return $sku;
}

function getStock($sku){
	global $conn;
	
	$query = "select stock from \"tp_php\".products where sku=".$sku.";";
	$result = pg_exec($conn, $query);
	$stock = pg_fetch_assoc($result)['stock'];
	
	return $stock;
}
?>