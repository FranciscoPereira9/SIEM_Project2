<?php

//VAI BUSCAR ÚLTIMO ID DE ORDEM PARA QUE NOVA ORDEM A ACRESCENTAR
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

//VAI BUSCAR ID DO CLIENTE COM BASE NO EMAIL FORNECIDO
function getClientId($email){
	global $conn;
	
	$query = "SELECT id FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$client_id = pg_fetch_row($result)[0];
	return $client_id;
}

//VAI BUSCAR MORADA DO UTILIZADOR COM O EMAIL MENCIONADO NO ARGUMENTO DE ENTRADA
function getDestination($email){
	global $conn;
	
	$query = "SELECT address FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$destination = pg_fetch_row($result)[0];
	
	if($destination==NULL){
		return null;
	}
	else{
		
		return $destination;
	}
}
//VAI BUSCAR CÓDIGO POSTAL DO UTILIZADOR COM O EMAIL MENCIONADO NO ARGUMENTO DE ENTRADA
function getPostalCode($email){
	global $conn;
	
	$query = "SELECT postalcode FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$postalcode = pg_fetch_row($result)[0];
	
	if($postalcode==NULL){
		return null;
	}
	else{
		
		return $postalcode;
	}
}
//VAI BUSCAR CIDADE DO UTILIZADOR COM O EMAIL MENCIONADO NO ARGUMENTO DE ENTRADA
function getCity($email){
	global $conn;
	
	$query = "SELECT city FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$city = pg_fetch_row($result)[0];
	
	if($city==NULL){
		return null;
	}
	else{
		
		return $city;
	}
}
//VAI BUSCAR MÉTODO DE PAGAMENTO DO UTILIZADOR COM O EMAIL MENCIONADO NO ARGUMENTO DE ENTRADA
function getPayment($email){
	global $conn;
	
	$query = "SELECT payment_method FROM \"tp_php\".customers WHERE email='".$email."';";
	
	$result = pg_exec($conn, $query);
	
	$payment = pg_fetch_row($result)[0];
	
	if($payment==NULL){
		return null;
	}
	else{
		
		return $payment;
	}
}
//ADICIONA NOVA ENCOMENDA A BASE DE DADOS
function addOrder($order_id, $clientId, $destination, $postalcode, $city, $date, $total_cost, $product, $product_price){
	global $conn;
	
	$query = "INSERT INTO \"tp_php\".orders (order_id, client, destination, postcode, city, date, order_status, total_order_price, product, product_price) 
	VALUES(".$order_id.", ".$clientId.", '".$destination."', '".$postalcode."', '".$city."', '".$date."', 'Processing', ".$total_cost.", ".$product.", ".$product_price.");";
	
	pg_exec($conn, $query);
	
	
	
	return NULL;
}
//ATUALIZA STOCK, QUER APÓS ENCOMENDA, QUER PARA ADICIONAR AO STOCK
function updateStock($sku, $stock){
	global $conn;
	
	$query = "UPDATE \"tp_php\".products SET stock=".$stock." WHERE sku=".$sku.";";
	
	pg_exec($conn, $query);
	
	return NULL;
}
?>