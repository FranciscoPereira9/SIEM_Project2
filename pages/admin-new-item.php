<?php
  session_start();
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
                <h1><a href="index.php">Fashion Store</a></h1>
              </div>
              <div class="header-container-c">
                <a href="user.php"><i class="far fa-user fa-2x"></i></a>
              </div>
              <div class="header-container-d">
                <a href="cart.php"><i class="fas fa-shopping-cart fa-2x"></i></a>
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
            <div class="canvas">
                <form class="form-layout" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="product-name">
                        <label for="product-name">Product Name </label>
                        <input type="text" id="product-name" name="product-name">
                        <?php
                         // Get values from form and verify if they exist
                          if (empty($_GET["product-name"])) {
                            echo "<br><p style=\"color:red; text-align:end;\" class=\"req\"> * required field</p>";
                          } else {
                            $name = test_input($_GET['product-name']);
                          }
                        ?>
                    </div>
                    <div class="product-price">
                        <label for="product-price">Price </label>
                        <input type="number" id="product-price" name="product-price">
                        <?php
                         // Get values from form and verify if they exist
                          if (empty($_GET["product-price"])) {
                            echo "<br><p style=\"color:red; text-align:end;\" class=\"error\"> * required field</p>";
                          } else {
                            $price = test_input($_GET['product-price']);
                          }
                        ?>
                    </div>    
                    <div class="product-category">
                        <label for="product-category">Category </label>
                        <input type="text" id="product-categoty" name="product-category">
                        <?php
                         // Get values from form and verify if they exist
                          if (empty($_GET["product-category"])) {
                            echo "<br><p style=\"color:red; text-align:end;\" class=\"error\"> * required field</p>";
                          } else {
                            $category = test_input($_GET['product-category']);
                          }
                        ?>
                    </div> 
                    <div class="product-brand">
                        <label for="product-brand">Brand </label>
                        <input type="text" id="product-brand" name="product-brand">
                        <?php
                         // Get values from form and verify if they exist
                          if (empty($_GET["product-brand"])) {
                            echo "<br><p style=\"color:red; text-align:end;\" class=\"error\"> * required field</p>";
                          } else {
                            $brand = test_input($_GET['product-brand']);
                          }
                        ?>
                    </div> 
                    <div class="product-ean">
                        <label for="product-ean">EAN </label>
                        <input type="text" id="product-ean" name="product-ean">
                        <?php
                         // Get values from form and verify if they exist
                          if (empty($_GET["product-ean"])) {
                            echo "<br><p style=\"color:red; text-align:end;\" class=\"error\"> * required field</p>";
                          } else {
                            $ean = test_input($_GET['product-ean']);
                          }
                        ?>
                    </div> 
                    <div class="product-quantity">
                        <label for="product-quantity">Quantity </label>
                        <input type="number" id="product-quantity" name="product-quantity">
                        <?php
                         // Get values from form and verify if they exist
                          if (empty($_GET["product-quantity"])) {
                            echo "<br><p style=\"color:red; text-align:end;\" class=\"error\"> * required field</p>";
                          } else {
                            $quantity = test_input($_GET['product-quantity']);
                          }
                        ?>
                    </div>
                    <div class="submit-but">
                        <input type="submit" class="btn btn-outline-secondary" value="Add Item">
                    </div>
                    <?php
                      if(isset($name) && isset($price) && isset($category) && isset($brand) && isset($ean) && isset($quantity)){
                        if(!isset($image)){
                          $image = null;
                        }
                        if(!isset($color)){
                          $color = null;
                        }
                        try {
                          add_product($conn, $name, $ean, $quantity, $category, $brand, $color, $price, $image);
                          echo "The item was added to the database.";
                        } catch (Exception $e) {
                          echo $e->getMessage(), "\n";
                        }
                      }
                    ?>
                </form>
            </div>
                        
            <!-- Side Bar JavaScript -->
            <script src="../js/side-bar.js"> </script>   

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        </main>
    </body>
</html>