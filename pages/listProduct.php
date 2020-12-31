<?php
	session_start();
	include_once "../includes/opendb.php";
	include_once "../database/db_product.php";
	
		if(!isset($_SESSION['cart'])){
	$_SESSION['cart']=array();
}
if(!isset($_SESSION['username'])){
	$_SESSION['username']='';
}
if(!isset($_SESSION['signinSuccess'])){
	$_SESSION['signinSuccess']='';
}
if(!isset($_SESSION['signupIncomplete'])){
	$_SESSION['signupIncomplete']='';
}
if(!isset($_SESSION['signupUserFail'])){
	$_SESSION['signupUserFail']='';
}
?>
<html>
    <?php


        $product='';
        
        //Filtrar resultados da pesquisa
        //TODO: por filtros também para marca, cor e qualquer cena que possa ser posta na bd
        if(isset($_GET['product'])){
			$product = $_GET['product'];
		}

        $products = getAllProducts($product);

        if(pg_numrows($products)>0){
            // Geração do HTML (tabela com a lista das cidades

            $row = pg_fetch_assoc($products);
			$last_ean = '';
            while (isset($row["ean"])) {
                if($row["ean"] != $last_ean){
					$last_ean = $row["ean"];
					echo "<a href=\"product.php?id=".$row['ean']."\">".$row['name']."</a><br>";
					
				}
                $row = pg_fetch_assoc($products);
            }
        }
	?>
</html>