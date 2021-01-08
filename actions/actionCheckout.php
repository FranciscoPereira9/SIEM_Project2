<?php

//TODO: retirar itens do stock, apagar cart das variáveis de sessão
session_start();

include_once "../includes/opendb.php";
include_once "../database/db_functions.php";
include_once "../database/db_orders.php";
include_once "../database/db_cart.php"; //função que vai buscar stock existente

var_dump($_SESSION);

if(!empty($_POST['checkout'])){
	
	$products=$_POST['products'];

	$cost=$_POST['cost'];

	$quantity=$_POST['quantity'];

	$total_cost=$_POST['total_cost'];
	
	

	if($_SESSION['username']!=''){
		// Get sequential order ID
		$order_id = getLastOrderId();
		$order_id = $order_id + 1;
		// Get today's date
		$today = date('Y-m-d');
		// Get client ID 
		$client_id = getClientId($_SESSION['email']);
		// Get client Destination
		$destination = getDestination($_SESSION['email']);
		// Get client Postal Code
		$postalcode = getPostalcode($_SESSION['email']);
		// Get client city
		$city = getcity($_SESSION['email']);

		
		if($destination==0 || $postalcode==0 || $city==0){
			
			$_SESSION['checkoutError'] = "*User info is lacking!";
			header("Location: ../pages/user.php");
			
		}else{
			if(empty($_SESSION['cart'])){
				$_SESSION['noItemsCart'] = "There are no items on cart to checkout!";
				header("Location:../pages/cart.php");
			}
			else{
				// Calculate total cost
				$total_order_price = 0; 
				foreach($_SESSION['cart'] as $n) {
					$total_order_price += intval($n['quantity'])*intval($n['price']);
				}

				// Place Orders for each item purchase -> individually
				foreach($_SESSION['cart'] as $n) {
					// Place order according to item quantity
					for ($i = 1; $i <= intval($n['quantity']); $i++) {
						addOrder($order_id, $client_id, $destination, $postalcode, $city, $today, $total_order_price, $n['sku'],  $n['price']);
					}
					// Update stock
					$stock = getStock($n['sku']);
					$newStock = $stock - intval($n['quantity']);
					updateStock($n['sku'], $newStock);
				}

				update_user_spent($conn, $client_id, $total_order_price);
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