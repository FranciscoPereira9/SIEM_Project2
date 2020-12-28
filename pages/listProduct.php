<?php
	session_start();
	include_once "../includes/opendb.php";
	include_once "../database/product.php";
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

            while (isset($row["sku"])) {
                
                echo "<a href=\"product.php?id=".$row['sku']."\">".$row['name']."</a><br>";
                $row = pg_fetch_assoc($products);
            }
        }
	?>
</html>