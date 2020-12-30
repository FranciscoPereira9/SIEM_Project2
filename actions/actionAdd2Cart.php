<?php
session_start();


function add_quantity_sku_cart($sku, $array){
	foreach ($array as $item){
       if (isset($item["sku"]) && $item["sku"] == $sku){
           $item["quantity"]=$item["quantity"]+1;
		   return true;
	   }
	}
	return false;
}
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
	$quantity = 1;
	
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
		   if(!add_quantity_sku_cart($sku, $_SESSION['cart'])){
			   $_SESSION['cart'][]=array("sku"=>"$sku", "price"=>"$price", "name"=>"$name", "color"=>"$color", "quantity"=>"$quantity");
			   
		   }else{
			   foreach ($_SESSION['cart'] as &$item){
				   if (isset($item["sku"]) && $item["sku"] == $sku){
					   $item["quantity"]=$item["quantity"]+1;
				   }
			   }
		   }
		}
		print_r($_SESSION['cart']);
	   header("Location: ../pages/product.php?id=".$ean."");
	 
   }
	   
}
?>