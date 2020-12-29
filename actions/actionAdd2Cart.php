<?php
session_start();

if(!isset($_SESSION['cart'])){
	$_SESSION['cart']=array();
}

include_once "../includes/opendb.php";
include_once "../database/db_cart.php";
if (!empty($_POST['add2cart'])){
	$ean = $_POST['ean'];
	$color = $_POST['color'];
	$name = $_POST['name'];
	$price = $_POST['price'];
	
	if (empty($ean) ||  empty($color)){
		
		$dadosValidos = false;
        //echo $dadosValidos;
	}
	else {
		$dadosValidos = true;
	}
	if(!$dadosValidos){
        $_SESSION['msgErroCart'] = "All fields are required.<p>";

            

        header("Location: ../pages/product.php?id=".$ean."");
   }
   else{
	   $sku=get_sku($ean, $color);
	   
	   if($sku==''){
		   $_SESSION['outOfStock'] = "Item of this color out of stock!";
		   header("Location: ../pages/product.php?id=".$ean."");
	   }else{
	   $_SESSION['cart'][]=array("sku"=>"$sku", "price"=>"$price", "name"=>"$name", "color"=>"$color");
	   //print_r($_SESSION['cart']);
	   header("Location: ../pages/cart.php");
	   }
   }
	   
}
?>