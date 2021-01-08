<?php
  session_start();
  include '../database/db_functions.php';
  include '../includes/opendb.php';
  
  if(!isset($_SESSION['successAddItem'])){
	  $_SESSION['successAddItem']=null;
  }
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" href="../css/style-admin-newitem.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/3ab706ac58.js" crossorigin="anonymous"></script>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
        <!-- jQuey CDN -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Website Tittle -->
        <title>Fashion Store</title>
    </head>
    <body>
        <header>
            <div class="header-container">
              <div class="header-container-a" id="mainbox" onclick="openSideBar()"> 
                  <span>&#9776;</span>
              </div>
              <div class="header-container-b">
                <h1><a href="index.php">Fashion Store</a></h1>
              </div>
              <div class="header-container-c">
                <a href="user.php"><i class="far fa-user fa-2x"></i></a>
              </div>
              <div class="header-container-d">
                <a href="cart.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
              </div>
				<?php 
					if(!empty($_SESSION['username'])){
					?><div class="header-container-e">
					  <b><a href="../actions/actionLogout.php">Logout</a></b>
					</div>   
				<?php } ?>			  
            </div>
        </header>
        <main>   
            <!-- Side Bar -->
            <div id="menu" class="sidemenu">
              <a href="listProduct.php?gender=Men">MEN</a>
              <a href="listProduct.php?gender=Women">WOMEN</a>
              <a href="#">CHILDREN</a>
              <a href="#" class="closebtn" onclick="closeSideBar()">&times;</a>
              <?php
                  if($_SESSION['email']== 'admin'){   
              ?>
              <div id="admin-benefits">
                <a href="dashboard.php">DASHBOARD</a>
                <a href="admin-orders.php">ORDERS</a>
                <a href="admin-products.php">PRODUCTS</a>
                <a href="admin-users.php">CUSTOMERS</a>
                <a href="admin-new-item.php">ADD NEW ITEM</a>
              </div>
              <?php
                }
              ?>
              <div id="currency">
                <form action="">
                  <select name="country" id="opt-country" form="country-form">
                    <option value="portugal">Portugal (€)</option>
                    <option value="spain">Spain (€)</option>
                    <option value="france">France (€)</option>
                    <option value="germany">Germany (€)</option>
                  </select>
                </form>
              </div>
            </div>

            <!-- Canvas -->
            <?php
              // Clean inputs
              function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;

              
                
              }
            ?>
            <h3>Add New Item</h3>
			<?php if(!empty($_SESSION['successAddItem'])){
					?><p class="success"> <?php echo $_SESSION['successAddItem'];?> </p>
					<?php
					$_SESSION['successAddItem']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}?>
			
            <div class="canvas">
				
                <form class="form-layout" action="../actions/actionAddNewItem.php" method="POST" enctype="multipart/form-data">
                    <div class="product-name">
                        <label for="product-name">Product Name </label><br>
                        <input type="text" id="product-name" name="product-name">
						
						<?php 
							//VERIFY ERRORS
							if(!empty($_SESSION['nameError'])){
							?><p class="success"> <?php echo $_SESSION['nameError'];?> </p>
							<?php
							$_SESSION['nameError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div>
                    <div class="product-price">
                        <label for="product-price">Price<br> </label><br>
                        <input type="numeric" id="product-price" name="product-price"  value="0" min="0">
                        <?php
                         // Get values from form and verify if they exist
                          if(!empty($_SESSION['priceError'])){
							?><p class="success"> <?php echo $_SESSION['priceError'];?> </p>
							<?php
							$_SESSION['priceError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div>    
                    <div class="product-category">
                        <label for="product-category">Category<br> </label><br>
						<select name="product-category">
							<option>Jackets</option>
							<option>Sweatshirts</option>
							<option>T-shirts</option>
							<option>Jeans</option>
							<option>Accessories</option>
						</select>
                        
						
                        <?php
                         // Get values from form and verify if they exist
                        
						if(!empty($_SESSION['categoryError'])){
							?><p class="success"> <?php echo $_SESSION['categoryError'];?> </p>
							<?php
							$_SESSION['categoryError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div> 
                    <div class="product-brand">
                        <label for="product-brand">Brand<br> </label><br>
                        <input type="text" id="product-brand" name="product-brand">
                        <?php
                         // Get values from form and verify if they exist
                       
						if(!empty($_SESSION['brandError'])){
							?><p class="success"> <?php echo $_SESSION['brandError'];?> </p>
							<?php
							$_SESSION['brandError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                       
                    </div> 
                    <div class="product-ean">
                        <label for="product-ean">EAN </label><br>
                        <input type="text" id="product-ean" name="product-ean">
                        <?php
                         // Get values from form and verify if they exist
                          if(!empty($_SESSION['eanError'])){
							?><p class="success"> <?php echo $_SESSION['eanError'];?> </p>
							<?php
							$_SESSION['eanError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div> 
                    <div class="product-quantity">
                        <label for="product-quantity">Quantity </label><br>
                        <input type="number" id="product-quantity" name="product-quantity" value="0" min="0">
                        <?php
                         // Get values from form and verify if they exist
                          if(!empty($_SESSION['quantityError'])){
							?><p class="success"> <?php echo $_SESSION['quantityError'];?> </p>
							<?php
							$_SESSION['quantityError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div>
					
					<div class="product-color">
                        <label for="color">Color </label><br>
						<select name="color">
							<option name="red">Red</option>
							<option name="orange">Orange</option>
							<option name="brown">Brown</option>
							<option name="yellow">Yellow</option>
							<option name="pink">Pink</option>
							<option name="blue">Blue</option>
							<option name="green">Green</option>
							<option name="gray">Gray</option>
							<option name="white">White</option>
							<option name="black">Black</option>
						</select>
                        <?php
                         // Get values from form and verify if they exist
                          if(!empty($_SESSION['colorError'])){
							?><p class="success"> <?php echo $_SESSION['colorError'];?> </p>
							<?php
							$_SESSION['colorError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div>
					
					 <div class="product-image">
                        <label for="image">Image </label><br>
                       <input type="file" name="image" id="image">
                        <?php
                         // Get values from form and verify if they exist
                          if(!empty($_SESSION['imageError'])){
							?><p class="success"> <?php echo $_SESSION['imageError'];?> </p>
							<?php
							$_SESSION['imageError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div>
                    <div class="submit-but">
                        <input type="submit" class="btn btn-outline-secondary" value="Add Item" name="additem">
                    </div>
					
					<div class="product-gender">
                        <label for="gender">Gender </label><br>
                        <select name="gender">
							<option name="Men">Men</option>
							<option name="Women">Women</option>
						</select>
                        <?php
                         // Get values from form and verify if they exist
                          if(!empty($_SESSION['genderError'])){
							?><p class="success"> <?php echo $_SESSION['genderError'];?> </p>
							<?php
							$_SESSION['genderError']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
						}?>
                    </div> 
                    
                </form>
            </div>
                        
            <!-- Side Bar JavaScript -->
            <script src="../js/side-bar.js"> </script>   

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        </main>
    </body>
</html>