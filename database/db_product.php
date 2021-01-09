<?php
//VAI BUSCAR TODOS PRODUTOS DA BASE DE DADOS
function getAllProducts($product, $gender){
	
	global $conn;
	$query = "select * from \"tp_php\".products where gender='$gender'";
	if(!empty($product)){
		$query .= "AND (LOWER(name) LIKE LOWER('%$product%') OR LOWER(color) LIKE LOWER('%$product%') OR LOWER(ean) LIKE LOWER('%$product%') OR LOWER(brand) LIKE LOWER('%$product%'))";
	}
	$query .= "ORDER BY sku ASC";
	$result = pg_exec($conn, $query);
	return $result;
	
}
//VAI BUSCAR PREÇO DE PRODUTO COM BASE NO SEU EAN
function getPrice($product_ean){
	global $conn;
	
	$query = "select price from \"tp_php\".products where ean='".$product_ean."';";
	
	$result = pg_exec($conn, $query);
	$price = pg_fetch_assoc($result)['price'];
	
	return $price;
}
//VAI BUSCAR NOME PRODUTO COM BASE NO SEU EAN
function getProductName($product_ean){
	global $conn;
	
	$query = "select name from \"tp_php\".products where ean='".$product_ean."';";
	
	$result = pg_exec($conn, $query);
	
	$name = pg_fetch_assoc($result)['name'];

	return $name;
}
//VAI BUSCAR CAMINHO DA IMAGEM DO PRODUTO COM BASE NO SEU EAN
function getImage($product_ean){
	global $conn;
	
	$query = "select * from \"tp_php\".products where ean='".$product_ean."';";
	
	$result = pg_exec($conn, $query);
	
	$row = pg_fetch_assoc($result);
	$gender = $row['gender'];
	$category = $row['category'];
	$img_source = $row['img'];
	
	$path="../images/products/".$gender."/".$category."/".$img_source.".jpg";
	
	return $path;
}
//VAI BUSCAR MARCA DO PRODUTO COM BASE NO SEU EAN
function getBrand($product_ean){
	global $conn;
	
	$query = "select brand from \"tp_php\".products where ean='".$product_ean."';";
	
	$result = pg_exec($conn, $query);
	
	$brand = pg_fetch_assoc($result)['brand'];
	
	return $brand;
}
//VAI BUSCAR STOCK DO PRODUTO COM BASE NO SEU EAN E NA SUA COR
function checkStock($ean, $color){
	global $conn;
	
	$query = "select stock from \"tp_php\".products where ean='".$ean."' and color='$color';";
	$result = pg_exec($conn, $query);
	
	if(pg_num_rows($result)==0){
		return false;
	}else{
		$stock = pg_fetch_assoc($result)['stock'];
		
		if($stock>0){
			return true;
			
		}else{
			return false;
		}
	}
}
	
?>