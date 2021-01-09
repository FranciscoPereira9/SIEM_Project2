<?php
session_start();

//ACESSO BASE DE DADOS
include_once "../includes/opendb.php";
include_once "../database/db_orders.php";
include_once "../database/db_cart.php";


//VERIFICA SE BOTÃO FOI CARREGADO E GUARDA VARIÁVEIS DE FORMULÁRIO
if (!empty($_POST['addstock'])){
	$ean = $_POST['ean'];
	$color = $_POST['color'];
	$quantity = $_POST['quantity'];
	$gender = $_POST['gender'];
	
	
	//VERIFICA VALIDADE DOS VALORES DOS FORMULÁRIOS
	if (empty($ean) ||  empty($color)){
		
		$dadosValidos = false;
	}
	else {
		$dadosValidos = true;
	}
	
	
	if(!$dadosValidos){
		
		//SE DADOS INVÁLIDOS GERA MENSAGEM DE ERRO
        $_SESSION['msgErroAddStock'] = "* All fields are required.";

            
		//REENCAMINHA PARA PÁGINA ANTERIOR COM MENSAGEM DE ERRO
        header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
   }
   else{
	   
	   //VAI BUSCAR SKU DO PRODUTO (CHAVE PRIMÁRIA)
	$sku=get_sku($ean, $color);
	   
	   //VERIFICA SE PRODUTO EXISTE
	   if($sku==''){
		   //NÃO EXISTE
		   
		   //GERA MENSAGEM DE ERRO
		   $_SESSION['outOfStock'] = "* Item not available!";
		   
		   //REENCAMINHA PARA PÁGINA ANTERIOR COM MENSAGEM DE ERRO
		   header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
	   }else{
		   //EXISTE
		   
		   //VAI BUSCAR STOCK ANTERIOR DO PRODUTO, E SOMA QUANTIDADE QUE SERÁ ADICONADA AO STOCK
		   $stock=getStock($sku);
		   $stock=$stock+$quantity;
		   
		   //ATUALIZA NOVO STOCK
		   updateStock($sku, $stock);
		   
		   //GERA MENSAGEM DE SUCESSO E REENCAMINHA PARA PÁGINA ANTERIOR COM MENSAGEM DE SUCESSO
		    $_SESSION['addStockSuccess'] = "Stock has updated successfully!";
		   header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
	   }
	   
}
}

		   
?>