<?php
  session_start();
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style-index.css" rel="stylesheet" >
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3ab706ac58.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <title>Fashion Store</title>
  </head>
  <body>
    <header>
      <?php 
        include_once "components/header_background.php";
        include_once "components/side_bar.php";
      ?>
    </header>
    <main>   
      <div id="menu" class="sidemenu">
        <a href="listProduct.php?gender=Men">MEN</a>
        <a href="listProduct.php?gender=Women">WOMEN</a>
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
      
      <!-- Search form -->
      <script src="../js/show-hint.js"></script>
      <form class="form-inline search-box" id="search" method="GET" action="listProduct.php">
        <input class="form-control form-control-lg mr-3" type="text" placeholder=" Search... " aria-label="Search" name="q">
		<p style="color:white">Women: <input type="radio" value="Women" name="gender">
		Men: <input type="radio" value="Men" name="gender" checked="checked"></p>
      </form>
	  
	  <?php if(!empty($_SESSION['checkoutSuccess'])){
					?><p> <?php #echo $_SESSION['checkoutSuccess'];?> </p>
					<?php
					$_SESSION['checkoutSuccess']  = NULL; //NULL PARA EVITAR QUE IMPRIMA LINHA BRANCA
				}?>

    </main>
    <script src="../js/side-bar.js"> </script>   
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>