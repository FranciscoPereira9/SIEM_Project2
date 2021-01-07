<?php
session_start();


include_once "../includes/opendb.php";
include_once "../database/db_orders.php";
include_once "../database/db_cart.php";


if (!empty($_POST['addstock'])){
	$ean = $_POST['ean'];
	$color = $_POST['color'];
	$quantity = $_POST['quantity'];
	$gender = $_POST['gender'];
	
	if (empty($ean) ||  empty($color)){
		
		$dadosValidos = false;
        //echo $dadosValidos;
	}
	else {
		$dadosValidos = true;
	}
	if(!$dadosValidos){
        $_SESSION['msgErroAddStock'] = "* All fields are required.";

            

        header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
   }
   else{
	$sku=get_sku($ean, $color);
	   
	   //VERIFICA SE PRODUTO EXISTE
	   if($sku==''){
		   //NÃO EXISTE
		   $_SESSION['outOfStock'] = "* Item not available!";
		   header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
	   }else{
		   //EXISTE
		   $stock=getStock($sku);
		   $stock=$stock+$quantity;
		   updateStock($sku, $stock);
		    $_SESSION['addStockSuccess'] = "Stock has updated successfully!";
		   header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
	   }
	   
}
}

		   
?>