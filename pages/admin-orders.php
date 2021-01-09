<?php
  session_start();
  include '../database/db_functions.php';
  include '../includes/opendb.php';
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style-admin-orders.css">
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

      <!-- Search form -->
      <script src="../js/show-hint.js"></script>
      <form class="form-inline search-box">
        <input class="form-control form-control-sm mr-3" type="text" placeholder=" Search... " aria-label="Search" id="fname" name="fname" onkeyup="showOrdersSearch(this.value)">
      </form>

      <h2>Orders</h2>

      <!-- Filter Products -->
      <div class="search-filter">
          
          <div class="price-range-slider">
            <label for="price_show">Price Range: </label>
            <input type="hidden" value=0 id="min_hiden_price">
            <input type="hidden" value=1000 id="max_hiden_price">
            <p id="price_show">0€ - 1000€</p>
            <div id="my_slider"></div> 
          </div>
          <div>
            <label for="pay_method">Payment Method</label>
            <select class="common_selector" id="pay_method"> 
              <option></option>
              <?php
                $pay_methods = distinct_payment_methods($conn);
                foreach($pay_methods as $row){ 
                  ?>
                  <option value="<?php echo $row['payment_method'] ?>"><?php echo $row['payment_method'] ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <div>
            <label for="city">City</label>
            <select class="common_selector" id="city"> 
              <option></option>
              <?php
                $cities = distinct_cities_orders($conn);
                foreach($cities as $row){ 
                  ?>
                  <option value="<?php echo $row['city'] ?>"><?php echo $row['city'] ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
          <div>
            <label for="status">Order Status</label>
            <select class="common_selector" id="status"> 
              <option></option>
              <?php
                $statuses = distinct_order_status($conn);
                foreach($statuses as $row){ 
                  ?>
                  <option value="<?php echo $row['order_status'] ?>"><?php echo $row['order_status'] ?></option>
                  <?php
                }
              ?>
            </select>
          </div>
        
      </div>
    
      <!-- Table with Orders -->
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Date</th>
            <th scope="col">Client</th>
            <th scope="col">Status</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Destination</th>
            <th scope="col">Post Code</th>
            <th scope="col">City</th>
            <th scope="col">Product</th>
            <th scope="col">Product Brand</th>
            <th scope="col">Product Price</th>
          </tr>
        </thead>
        <tbody id="txtHint" class="filter_data">
        </tbody>
      </table>

      <!-- Refresh Filtered Page Script --> 
      <style>
        #loading { text-align:center; height: 150px;}
      </style>
      <script src="../js/orders-filter.js"></script>    

    </main>
    <script src="../js/side-bar.js"> </script>   
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>