<?php

session_start();


//ACESSO A BASE DE DADOS
include_once "../includes/opendb.php";
include_once "../database/db_functions.php";
include_once "../database/db_orders.php";
include_once "../database/db_cart.php"; //função que vai buscar stock existente

var_dump($_SESSION);


//VERIFICA SE BOTÃO FOI CARREGADO E GUARDA VARIÁVEIS FORMULÁRIO
if(!empty($_POST['checkout'])){
	
	$products=$_POST['products'];

	$cost=$_POST['cost'];

	$quantity=$_POST['quantity'];

	$total_cost=$_POST['total_cost'];
	
	
	//VERIFICA SE UTLIZADOR TEM SESSÃO INICIADA
	if(!empty($_SESSION['username'])){
		
		//SESSÃO ABERTA
		
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
		//Get client payment details
		$payment = getPayment($_SESSION['email']);
	

		//VERIFICA SE UTILIZADOR JÁ TEM DADOS NECESSÁRIOS PARA PAGAMENTO ATUALIZADOS
		if(!$destination || !$postalcode || !$city || !$payment){
			
			
			//SE NÃO TIVER DADOS, GERA MENSAGEM DE ERRO E REENCAMINHA PARA ESPACÇO DE UTILIZADOR
			$_SESSION['checkoutError'] = "*User info is lacking!";
			header("Location: ../pages/user.php");
			
		}else{
			if(empty($_SESSION['cart'])){
				//VERIFICA SE CARRINHO E ESTÁ VAZIO
				
				//MENSAGEM A DIZER QUE CARRINHO ESTÁ VAZIO E REENCAMINHA PARA PÁGINA ANTERIOR
				$_SESSION['noItemsCart'] = "There are no items on cart to checkout!";
				header("Location:../pages/cart.php");
			}
			else{
				// Calculate total cost
				$total_order_price = 0; 
				foreach($_SESSION['cart'] as $n) {
					$total_order_price += floatval($n['quantity'])*floatval($n['price']);
				}

				// Place Orders for each item purchase -> individually
				foreach($_SESSION['cart'] as $n) {
					// Place order according to item quantity
					for ($i = 1; $i <= floatval($n['quantity']); $i++) {
						addOrder($order_id, $client_id, $destination, $postalcode, $city, $today, $total_order_price, $n['sku'],  $n['price']);
					}
					// Update stock
					$stock = getStock($n['sku']);
					$newStock = $stock - floatval($n['quantity']);
					updateStock($n['sku'], $newStock);
				}
				
				//ATUALIZA VALOR GASTO PELO CLIENTE
				update_user_spent($conn, $client_id, $total_order_price);
				
				//reinicia array de sessão PARA CARRINHO
				$_SESSION['cart']=array();
				
				//GERA MENSAGEM DE SUCESSO E REENCAMINHA PARA PÁGINA DO CARRINHO
				$_SESSION['checkoutSuccess'] = "Checkout finished successfully!";
				
				header("Location:../pages/cart.php");
			}
			
		}		
		
		
	}
	else{
		
		//SESSÃO NÃO FOI INICIADA ENTÃO ENCAMINHA PARA ESPAÇO DE UTILIZADOR PARA ESTE INICIAR SESSÃO
		header("Location: ../pages/user.php");
	}
}


?>