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
	$img = $_POST['img'];
	$gender = $_POST['gender'];
	$quantity = 1;
	
	if (empty($ean) ||  empty($color)){
		
		$dadosValidos = false;
        //echo $dadosValidos;
	}
	else {
		$dadosValidos = true;
	}
	if(!$dadosValidos){
        $_SESSION['msgErroCart'] = "* All fields are required.";

            

        header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
   }
   else{
	   //IDENTIFICADOR PRODUTO
	   $sku=get_sku($ean, $color);
	   
	   //VERIFICA SE PRODUTO EXISTE
	   if($sku==''){
		   //PRODUTO NÃO EXISTE
		   $_SESSION['outOfStock'] = "* Item of this color out of stock!";
		   header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
	   }else{
		   //VERIFICA QUANTOS PRODUTOS DESSE MODELO JÁ ESTÃO NO CARRINHO
		   foreach ($_SESSION['cart'] as &$item){
			  if (isset($item["sku"]) && $item["sku"] == $sku){
				   $actual_quantity=$item["quantity"];
			  }
			}
		   
		   //VERIFICA SE PRODUTO TEM STOCK SUFICIENTE
		   if(getStock($sku)-$actual_quantity<=0){
			   //PRODUTO NÃO TEM STOCK SUFICIENTE
				$_SESSION['outOfStock'] = "* Item of this color out of stock!";
			}else{
				//PRODUTO TEM STOCK SUFICIENTE
				
				//VERIFICA SE PRODUTO JÁ ESTÁ NO CARRINHO
			   if(!add_quantity_sku_cart($sku, $_SESSION['cart'])){
				   //NÃO ESTÁ NO CARRINHO
				   $_SESSION['cart'][]=array("sku"=>"$sku", "price"=>"$price", "name"=>"$name", "color"=>"$color", "quantity"=>"$quantity", "img"=>"$img");
				   $_SESSION['cartSuccess'] = "Item added to cart!";
				   
			   }else{
					//ESTÁ NO CARRINHO
				   foreach ($_SESSION['cart'] as &$item){
					   if (isset($item["sku"]) && $item["sku"] == $sku){
						   $item["quantity"]=$item["quantity"]+1;
					   }
				   }
				   $_SESSION['cartSuccess'] = "Item added to cart!";
			   }
		   }
		}
		print_r($_SESSION['cart']);
	   header("Location: ../pages/product.php?id=".$ean."&gender=$gender");
	 
   }
	   
}
?>