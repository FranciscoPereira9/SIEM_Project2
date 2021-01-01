<?php

//TODO: retirar itens do stock, apagar cart das variáveis de sessão
session_start();

include_once "../includes/opendb.php";
    include_once "../database/db_orders.php";

$products=$_POST['products'];

$cost=$_POST['cost'];

$total_cost=$_POST['total_cost'];

if($_SESSION['username']!=''){
	
	$order_id = getLastOrderId();
	//echo $order_id;
	//echo "<br>";
	$order_id = $order_id + 1;
	//echo $order_id;
	//echo "<br>";
	$today = date('Y-m-d');
	//echo $today;
	//echo "<br>";
	$client_id = getClientId($_SESSION['email']);
	//echo $client_id;
	//echo "<br>";
	$destination = getDestination($_SESSION['email']);
	//echo $destination;
	//echo "<br>";
	$postalcode = getPostalcode($_SESSION['email']);
	//echo $postalcode;
	//echo "<br>";
	$city = getcity($_SESSION['email']);
	//echo $city;
	//echo "<br>";
	//echo $total_cost;
	//echo "<br>";
	
	if($destination==0 || $postalcode==0 || $city==0){
		
		$_SESSION['checkoutError'] = "User info is lacking!<b>";
		header("Location: ../pages/user.php");
		
	}else{
		if(empty($products)){
			$_SESSION['noItemsCart'] = "There are no items on cart to checkout!<b>";
			header("Location:../pages/user.php");
		}
		else{
			foreach($products as $key=>$item) {
				//echo $item.'-'.$cost[$key];
				//echo "<br>";
				addOrder($order_id, $client_id, $destination, $postalcode, $city, $today, $total_cost, $item, $cost[$key]);
			}
			
			header("Location:../pages/index.php");
		}
		
	}		
	
	
}
else{
	header("Location: ../pages/user.php");
}


?>