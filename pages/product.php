<?php

//TODO: adicionar imagem
	session_start();
	
	include_once "../includes/opendb.php";
	include_once "../database/db_product.php";
	
		if(!isset($_SESSION['cart'])){
	$_SESSION['cart']=array();
}
if(!isset($_SESSION['username'])){
	$_SESSION['username']='';
}

if(!isset($_SESSION['email'])){
	$_SESSION['email']='';
}

if(!isset($_SESSION['msgErroCart'])){
	$_SESSION['msgErroCart']='';
}
if(!isset($_SESSION['outOfStock'])){
	$_SESSION['outOfStock']='';
}
	
	$product_ean=$_GET['id'];
	
	$price=getPrice($product_ean);
	$name=getProductName($product_ean);
?>

<html>
    <body>
	<h3><?php echo $name ?></h3>
	<?php if($_SESSION['msgErroCart'] != ''){
		echo $_SESSION['msgErroCart'];
		$_SESSION['msgErroCart']='';
	}
	if($_SESSION['outOfStock']!=''){
		echo$_SESSION['outOfStock'];
		$_SESSION['outOfStock']='';
	}?>
        <form method="POST" action="../actions/actionAdd2Cart.php">
        Size: <select name="size">
                    <option>XS</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                </select><br><br>

		   Red: 	<input type="radio" value="red" name="color"></input><br>
           Orange: <input type="radio" value="orange" name="color"></input><br>
           Brown: <input type="radio" value="brown" name="color"></input><br>
           Yellow: <input type="radio" value="yellow" name="color"></input><br>
           Pink: <input type="radio" value="pink" name="color"></input><br>
           Blue: <input type="radio" value="blue" name="color"></input><br>
           Green: <input type="radio" value="green" name="color"></input><br>
           Gray: <input type="radio" value="gray" name="color"></input><br>
           White: <input type="radio" value="white" name="color"></input><br>
           Black: <input type="radio" value="black" name="color"></input><br>
		   <br>
		   
		   <?php echo "$price €<br>";?>
		   
		<input type="hidden" name="ean" value="<?php echo $product_ean; ?>">
		<input type="hidden" name="price" value="<?php echo $price; ?>">
		<input type="hidden" name="name" value="<?php echo $name; ?>">


		<input type="submit" name="add2cart" value="ADD TO CART"></input><br>
		</form>
    </body>
</html>