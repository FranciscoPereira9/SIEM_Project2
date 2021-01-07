<?php
session_start();
	//TODO: página do cart, finalizar compra, alterar dados utilizador.
	//Ajax post, para alterar variáveis de sessão, ver tutorial


// depois para limpar array: $_SESSION['cart']=array();
//print_r($_SESSION['cart']);

?>

<html>

	<head>
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../css/style-cart.css" rel="stylesheet" >
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
	<?php 
		include_once "components/header.php";
		include_once "components/side_bar.php";
	?>
	<h3 style="text-align: center; margin-bottom:50px;"> CART </h3>

	<div class="container1">	
		<div id="left">

			<?php
			if(!empty($_SESSION['noItemsCart'])||empty($_SESSION['cart'])){
					?><p> <?php echo "There are no items on cart to checkout!";?> </p>
					<?php
					$_SESSION['noItemsCart']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}?>
			
			<table id="table-left">
				<?php
				//preciso Ajax aqui para alterar variável de sessão para quantidade
					$total_price=0;
					$cost=array();
					$n=0;
					foreach ($_SESSION['cart'] as $item){
						$full_price=$item['quantity']*$item['price'];
						$cost[]=$full_price;
						$total_price+=$full_price;
						$img = $item['img'];
						echo "<tr id=\"product".$n."\"> <td><img src= \"$img\"></td>";
						echo "<td>".$item['name']."</td> 
							<td><form><input type=\"number\" class='common_selector' id=\"quantity".$n."\" name=\"quantity\" value=\"".$item['quantity']."\"></form></td>
							<td id='price_multiplied".$n."'> </tr><br>";
						$n=$n+1;
					}
					$products = array_column($_SESSION['cart'], 'sku');
					$quantity = array_column($_SESSION['cart'], 'quantity');
					?>
			</table>
		</div>
		<script src="../js/change_cart_price.js"></script>  
		<div id="right">
			<table style="margin-bottom: 10px">
				<tr>
					<td>Items:</td>
					<td id="items_price"><b><?php echo "$total_price €"; ?></b></td>
				</tr>
				<tr>
					<td>Shipping:</td>
					<td><b>0,00€</b></td>
				</tr>
				<tr style="border-top: 1px solid #666666">
					<td><b>Total:</b></td>
					<td id="total_price"><b><?php echo "$total_price €"; ?></b></td>
				</tr>
			</table>
			<form method="POST" action="../actions/actionCheckout.php">
				<?php foreach($products as $value)
					{
						echo '<input type="hidden" name="products[]" value="'. $value. '">';
					}
					foreach($cost as $value)
					{
						echo '<input type="hidden" name="cost[]" value="'. $value. '">';
					}
					foreach($quantity as $value)
					{
						echo '<input type="hidden" name="quantity[]" value="'. $value. '">';
					}
				?>
				<input type="hidden" name="total_cost" value="<?php echo $total_price; ?>">
				<input type="submit" name="checkout" value="Checkout" class="btn btn-outline-secondary">
			</form>
		</div>
	</div>
</html>