<?php
session_start();
	//TODO: página do cart, finalizar compra, alterar dados utilizador.
	//Ajax post, para alterar variáveis de sessão, ver tutorial


// depois para limpar array: $_SESSION['cart']=array();
//print_r($_SESSION['cart']);
?>

<html>
	<table >
		<?php
			$total_price=0;
			$cost=array();
			foreach ($_SESSION['cart'] as $item){
				$full_price=$item['quantity']*$item['price'];
				$cost[]=$full_price;
				$total_price+=$full_price;
				echo "<tr><td style=\"padding: 15\">".$item['name']."</td> <td style=\"padding: 15\"><form><input type=\"number\" \
				name=\"quantity\" value=\"".$item['quantity']."\"></form></td><td style=\"padding: 15\">".$full_price."</td></tr><br>";
			}
			$products = array_column($_SESSION['cart'], 'sku');
			?>
	</table>
	<?php echo $total_price; ?>
	<form method="POST" action="../actions/actionCheckout.php">
		<?php foreach($products as $value)
			{
				echo '<input type="hidden" name="products[]" value="'. $value. '">';
			}
			foreach($cost as $value)
			{
				echo '<input type="hidden" name="cost[]" value="'. $value. '">';
			}
		?>
		<input type="hidden" name="total_cost" value="<?php echo $total_price; ?>">
		<input type="submit" name="checkout" value="Checkout">
	</form>
</html>