<?php

function getLastOrderId(){
	global $conn;
	
	$query = "SELECT order_id FROM \"tp_php\".orders ORDER BY order_id DESC;";
	
	$result = pg_exec($conn, $query);
	
	if(pg_num_rows($result)==0){
		return 0;
	}
	else{
		$order_id = pg_fetch_row($result)[0];
		return $order_id;
	}
}

function getClientId($email){
	global $conn;
	
	$query = "SELECT id FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$client_id = pg_fetch_row($result)[0];
	return $client_id;
}

function getDestination($email){
	global $conn;
	
	$query = "SELECT address FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$destination = pg_fetch_row($result)[0];
	
	if($destination==NULL){
		return 0;
	}
	else{
		
		return $destination;
	}
}
function getPostalCode($email){
	global $conn;
	
	$query = "SELECT postalcode FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$postalcode = pg_fetch_row($result)[0];
	
	if($postalcode==NULL){
		return 0;
	}
	else{
		
		return $postalcode;
	}
}
function getCity($email){
	global $conn;
	
	$query = "SELECT city FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$city = pg_fetch_row($result)[0];
	
	if($city==NULL){
		return 0;
	}
	else{
		
		return $city;
	}
}

function addOrder($order_id, $clientId, $destination, $postalcode, $city, $date, $total_cost, $product, $product_price){
	global $conn;
	
	$query = "INSERT INTO \"tp_php\".orders (order_id, client, destination, postcode, city, date, order_status, total_order_price, product, product_price) 
	VALUES(".$order_id.", ".$clientId.", '".$destination."', '".$postalcode."', '".$city."', '".$date."', 'Processing', ".$total_cost.", ".$product.", ".$product_price.");";
	
	pg_exec($conn, $query);
	
	
	
	return NULL;
}

function updateStock($sku, $stock){
	global $conn;
	
	$query = "UPDATE \"tp_php\".products SET stock=".$stock." WHERE sku=".$sku.";";
	
	pg_exec($conn, $query);
	
	return NULL;
}
?>