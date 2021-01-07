<?php

	session_start();
	
	include_once "../includes/opendb.php";
	include_once "../database/db_product.php";

	
	$product_ean=$_GET['id'];
	$gender=$_GET['gender'];
	
	$price=getPrice($product_ean);
	$name=getProductName($product_ean);
	$img_source=getImage($product_ean);
	$brand=getBrand($product_ean);
?>

<html>

<head>
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../css/style-product.css" rel="stylesheet" >
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/3ab706ac58.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
		
		<title>Fashion Store</title>
	</head>
	
	<body>
	<?php 
		include_once "components/header.php";
		include_once "components/side_bar.php";
		include_once "components/search_bar.php";
		
	?>
    
	
		
		<div class="container1">
		
		  
		  <div id="left">
			<?php
			echo "<img src=\"$img_source\">";
			?>
		  </div>
		  
		  <div id = "right">
			<h3><?php echo $name ?></h3>
			
				<?php 
				//VARIÁVEL SESSÃO OUT OF STOCK
				if(!empty($_SESSION['outOfStock'])){
					?><p class="error"> <?php echo $_SESSION['outOfStock'];?> </p>
					<?php
					$_SESSION['outOfStock']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}
				
				//VARIAVEL SESSAO SUCESSO A ADICIONAR A CARRINHO
				if(!empty($_SESSION['cartSuccess'])){
					?><p class="success"> <?php echo $_SESSION['cartSuccess'];?> </p>
					<?php
					$_SESSION['cartSuccess']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}
				
				//VARIAVEL SESSAO ADICIONAR STOCK INCOMPLETO
				if(!empty($_SESSION['msgErroAddStock'])){
					?><p class="error"> <?php echo $_SESSION['msgErroAddStock'];?> </p>
					<?php
					$_SESSION['msgErroAddStock']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}
				
				
				//VARIAVEL SESSAO SUCESSO ADICIOANR STOCK
				if(!empty($_SESSION['addStockSuccess'])){
					?><p class="success"> <?php echo $_SESSION['addStockSuccess'];?> </p>
					<?php
					$_SESSION['addStockSuccess']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}
				?>
			<p><b>Brand: </b><?php echo $brand;?></p>
			<?php if($_SESSION['email']!='admin'){?>
				<form method="POST" action="../actions/actionAdd2Cart.php">
			<?php }else{?>
				<form method="POST" action="../actions/actionAddStock.php">
		
			<?php } ?>
			<table>
			<tr><td>Size:</td><td><select name="size">
						<option>XS</option>
						<option>S</option>
						<option>M</option>
						<option>L</option>
						<option>XL</option>
					</select></td></tr>
			<tr><td>Color:</td><td><select name="color">
						<?php if(checkStock($product_ean, 'Red')){?><option name="red">Red</option><?php }?>
						<?php if(checkStock($product_ean, 'Orange')){?><option name="orange">Orange</option><?php }?>
						<?php if(checkStock($product_ean, 'Brown')){?><option name="brown">Brown</option><?php }?>
						<?php if(checkStock($product_ean, 'Yellow')){?><option name="yellow">Yellow</option><?php }?>
						<?php if(checkStock($product_ean, 'Pink')){?><option name="pink">Pink</option><?php }?>
						<?php if(checkStock($product_ean, 'Blue')){?><option name="blue">Blue</option><?php }?>
						<?php if(checkStock($product_ean, 'Green')){?><option name="green">Green</option><?php }?>
						<?php if(checkStock($product_ean, 'Gray')){?><option name="gray">Gray</option><?php }?>
						<?php if(checkStock($product_ean, 'White')){?><option name="white">White</option><?php }?>
						<?php if(checkStock($product_ean, 'Black')){?><option name="black">Black</option><?php }?>
					</select></td></tr>
			<?php
			//CASO ADMINISTRADOR
			if($_SESSION['email']=='admin'){
				?><tr><td>Quantity: </td><td><input type="number" name="quantity" value="1" min="1"></td></tr>
			<?php 
			}?>
			</table>
			   <p><b><?php echo "$price €<br>";?></b></p>
			   
			<input type="hidden" name="ean" value="<?php echo $product_ean; ?>">
			<input type="hidden" name="price" value="<?php echo $price; ?>">
			<input type="hidden" name="name" value="<?php echo $name; ?>">
			<input type="hidden" name="img" value="<?php echo $img_source; ?>">
			<input type="hidden" name="gender" value="<?php echo $gender; ?>">

			<?php if($_SESSION['email']!='admin'){?>
				<input type="submit" name="add2cart" value="ADD TO CART" class="btn btn-outline-secondary"></input><br>
			<?php }else{?>
				<input type="submit" name="addstock" value="ADD STOCK" class="btn btn-outline-secondary"></input><br>
			<?php } ?>
			</form>
			
			</div>
		</div>
	
    </body>
</html>