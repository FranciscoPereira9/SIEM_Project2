<?php


function get_sku($ean, $color){
	global $conn;
	
	$query = "select sku from \"tp_php\".products where ean='".$ean."' and color='".$color."';";
	
	$result = pg_exec($conn, $query);
	$sku = pg_fetch_assoc($result)['sku'];
	
	return $sku;
}
?>