<?php
  include '../database/db_functions.php';
  include '../includes/opendb.php';
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
                <h1><a href="index.html">Fashion Store</a></h1>
              </div>
              <div class="header-container-c">
                <a href="user-view.html"><i class="far fa-user fa-2x"></i></a>
              </div>
              <div class="header-container-d">
                <a href="cart-view.html"><i class="fas fa-shopping-cart fa-2x"></i></a>
              </div>      
            </div>
        </header>
        <main>   
            <!-- Side Bar -->
            <div id="menu" class="sidemenu">
              <a href="#">MEN</a>
              <a href="#">WOMEN</a>
              <a href="#">CHILDREN</a>
              <a href="#" class="closebtn" onclick="closeSideBar()">&times;</a>
              <div id="admin-benefits">
                <a href="#">DASHBOARD</a>
                <a href="#">ORDERS</a>
                <a href="#">PRODUCTS</a>
                <a href="#">CUSTOMERS</a>
              </div>
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
            <h3>Add New Item</h3>
            <div class="canvas">
                <form class="form-layout" action="">
                    <div class="product-name">
                        <label for="product-name">Product Name </label>
                        <input type="text" id="product-name" name="product-name">
                    </div>
                    <div class="product-price">
                        <label for="product-price">Price </label>
                        <input type="text" id="product-price" name="product-price">
                    </div>    
                    <div class="product-category">
                        <label for="product-category">Category </label>
                        <input type="text" id="product-categoty" name="product-category">
                    </div> 
                    <div class="product-brand">
                        <label for="product-brand">Brand </label>
                        <input type="text" id="product-brand" name="product-brand">
                    </div> 
                    <div class="product-ean">
                        <label for="product-ean">EAN </label>
                        <input type="text" id="product-ean" name="product-ean">
                    </div> 
                    <div class="product-quantity">
                        <label for="product-quantity">Quantity </label>
                        <input type="text" id="product-quantity" name="product-quantity">
                    </div>
                    <div class="submit-but">
                        <input type="submit" class="btn btn-outline-secondary" value="Add Item">
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