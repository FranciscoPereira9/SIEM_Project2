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
	$img_source=getImage($product_ean);
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
			<?php if($_SESSION['msgErroCart'] != ''){
				echo $_SESSION['msgErroCart'];
				$_SESSION['msgErroCart']=NULL;
			}
			if($_SESSION['outOfStock']!=''){
				echo$_SESSION['outOfStock'];
				$_SESSION['outOfStock']=NULL;
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
		<input type="hidden" name="img" value="<?php echo $img_source; ?>">


		<input type="submit" name="add2cart" value="ADD TO CART"></input><br>
		</form>
		
		</div>
	</div>
    </body>
</html>