<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style-index.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3ab706ac58.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
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
    <div id="menu" class="sidemenu">
      <a href="#">MEN</a>
      <a href="#">WOMEN</a>
      <a href="#">CHILDREN</a>
      <a href="#" class="closebtn" onclick="closeSideBar()">&times;</a>  
      <?php
        if($_SESSION['username'] == 'admin'){
          echo "<a href=\"#\">DASHBOARD</a>";
        }
      ?>
    </div>

    <!-- Search form -->
    <form class="form-inline search-box">
      <input class="form-control form-control-lg mr-3" type="text" placeholder=" Search... " aria-label="Search">
    </form>

  </main>
  <script src="../js/side-bar.js"> </script>   
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
  </body>
</html>