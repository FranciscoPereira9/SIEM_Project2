<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" type="text/css" href="../css/style-header.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/3ab706ac58.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
	
 
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
</body>