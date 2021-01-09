

<html>
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="../css/style-sidebar.css">
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
		<main>
			<!-- Side Bar -->
      <div id="menu" class="sidemenu">
        <div class="up">
          <a href="listProduct.php?gender=Men">MEN</a>
          <a href="listProduct.php?gender=Women">WOMEN</a>
          <a href="#">CHILDREN</a>
          <a href="#" class="closebtn" onclick="closeSideBar()">&times;</a>
        </div>
        <div class="down">
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
            
        
      </div>
		</main>
		<script src="../js/side-bar.js"> </script>
	</body>
	
</html>