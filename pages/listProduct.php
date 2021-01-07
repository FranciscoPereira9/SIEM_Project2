<?php
	session_start();
	include_once "../database/db_functions.php";
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
	<head>
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../css/style-product-list.css" rel="stylesheet" >
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
		?>
		<?php
			//include_once "components/search_bar.php";
		?>
	 	<!--<form id="search" method="GET" action="listProduct.php">
		<p><label for="Search">Search:<input type="text" name="product"/ value="<?php if(!empty($product)){echo $product;} ?>"></p> 
		</form>-->
		<div class="plano">

			<!-- Search form -->
			<script src="../js/show-hint.js"></script>
			<form class="form-inline search-box">
				<input class="form-control form-control-sm mr-3" type="text" placeholder=" Search... " aria-label="Search" id="fname" name="fname" onkeyup="showUserProductsSearch(this.value)">
			</form>


			<!-- Filter Products -->
			<div class="search-filter">       
				<div class="price-range-slider">
					<label for="price_show">Price Range: </label>
					<input type="hidden" value=0 id="min_hiden_price">
					<input type="hidden" value=1000 id="max_hiden_price">
					<p id="price_show">0 - 1000</p>
					<div id="my_slider"></div> 
				</div>
				<div>
					<label for="brand">Category</label>
					<select class="common_selector" id="category"> 
						<option></option>
						<?php
						$categories = distinct_categories($conn);
						foreach($categories as $row){ 
							?>
							<option value="<?php echo $row['category'] ?>"><?php echo $row['category'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div>
					<label for="brand">Color</label>
					<select class="common_selector" id="color">
						<option></option> 
						<?php
						$categories = distinct_colors($conn);
						foreach($categories as $row){ 
							?>
							<option value="<?php echo $row['color'] ?>"><?php echo $row['color'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div>
					<label for="brand">Brand</label>
					<select class="common_selector" id="brand"> 
						<option></option>
						<?php
						$categories = distinct_brands($conn);
						foreach($categories as $row){ 
							?>
							<option value="<?php echo $row['brand'] ?>"><?php echo $row['brand'] ?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>


			<div class="flex-box filter_data" id="txtHint">
				<?php
				/*

					$product='';
					if(isset($_GET['product'])){
						$product = $_GET['product'];
					}
					$gender='Men';
					if(isset($_GET['gender'])){
						$gender = $_GET['gender'];
					}
					
					//Filtrar resultados da pesquisa
					//TODO: por filtros também para marca, cor e qualquer cena que possa ser posta na bd
					if(isset($_GET['product'])){
						$product = $_GET['product'];
					}

					$products = getAllProducts($product, $gender);

					if(pg_numrows($products)>0){
						// Geração do HTML (tabela com a lista das cidades

						$row = pg_fetch_assoc($products);
						$last_ean = '';
						while (isset($row["ean"])) {
							if($row["ean"] != $last_ean){
								$last_ean = $row["ean"];
								$img_source =$row['img'];
								$gender = $row['gender'];
								$category = $row['category'];
								$price = $row['price'];
								echo "<div class=\"flex-element\">";
								//echo "\"../images/products/".$gender."/".$category."/".$img_source.".jpg\"";
								echo "<a href=\"product.php?id=".$row['ean']."&gender=$gender\"><img src=\"../images/products/".$gender."/".$category."/".$img_source.".jpg\"></a><br>";
								echo "<a href=\"product.php?id=".$row['ean']."&gender=$gender\">".$row['name']."</a><br>";
								echo "<p><b>$price €</b></p>";
								echo "</div>";
								
							}
							$row = pg_fetch_assoc($products);
						}
					}
					*/
				?>
			</div>
		</div>		
		<!-- Refresh Filtered Page Script --> 
		<style>
		#loading { text-align:center; height: 150px;}
		</style>
		<script src="../js/products-filter-user.js"></script>
	</body>

</html>