<?php

//TODO: retirar itens do stock, apagar cart das variáveis de sessão
session_start();

include_once "../includes/opendb.php";
include_once "../database/db_orders.php";
include_once "../database/db_cart.php"; //função que vai buscar stock existente


if(!empty($_POST['checkout'])){
	
	$products=$_POST['products'];

	$cost=$_POST['cost'];

	$quantity=$_POST['quantity'];

	$total_cost=$_POST['total_cost'];

	if(!empty($_SESSION['username'])){
		
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
			
			$_SESSION['checkoutError'] = "*User info is lacking!";
			header("Location: ../pages/user.php");
			
		}else{
			if(empty($products)){
				$_SESSION['noItemsCart'] = "There are no items on cart to checkout!";
				header("Location:../pages/cart.php");
			}
			else{
				foreach($products as $key=>$item) {
					//echo $item.'-'.$cost[$key];
					//echo "<br>";
					addOrder($order_id, $client_id, $destination, $postalcode, $city, $today, $total_cost, $item, $cost[$key]);
					$stock = getStock($item);
					$newStock = $stock - $quantity[$key];
					echo $newStock;
					updateStock($item, $newStock);
					update_user_spent($conn, $client_id, $spent);
				}
				
				//reinicia array de sessão
				$_SESSION['cart']=array();
				
				$_SESSION['checkoutSuccess'] = "Checkout finished successfully!";
				
				header("Location:../pages/cart.php");
			}
			
		}		
		
		
	}
	else{
		header("Location: ../pages/user.php");
	}
}


?>