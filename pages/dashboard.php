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
        <link rel="stylesheet" href="../css/style-admin-dashboard.css">
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
      
            <h2>Dashboard</h2>
            <!-- Dashboard -->
            <div class= 'dashboard'>

              <!-- KPIs -->
              <div class="kpis">
                  <div class= "kpi1"> 
                    <?php
                      printf("<h3>%.2f€</h3>", revenue_sales($conn)[0]);
                    ?>
                    <p>Sales</p>
                  </div>
                  <div class= "kpi2">
                    <?php
                      printf("<h3>%.2f€</h3>", avg_cart($conn)[0]);
                    ?>
                    <p>Average Cart</p>
                  </div>
                  <div class= "kpi3">
                    <?php
                      printf("<h3>%.0f</h3>", n_customers($conn)[0]);
                    ?>
                    <p>Clients</p>
                  </div>
              </div>
              <!-- Chart -->
              <div id="curve_chart" style="width: 100%; height: 70%" >
                  
              </div>
            
            </div>
            <!-- Google Charts JavaScript API -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current',{ callback: function () { drawChart(); $(window).resize(drawChart);}, packages:['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Index', 'Sales in €'],
                    <?php
                      // Get data from db
                      $data = chart_data($conn);

                      $n = count($data);
                      $a = 0;
                      
                      foreach($data as $row){
                          
                          if($a < $n-1){
                              echo "['".$row["date"]."',".$row["sum"]."],\n";
                          }
                          else{
                              echo "['".$row["date"]."',".$row["sum"]."]";
                          }
                          $a++;
                      }
                    ?>    
                    ]);

                    var options = {
                      // title: 'none',
                      backgroundColor: '#3c3c3c',
                      legendTextStyle: { color: '#FFF' },
                      columnType: 'string',
                      curveType: 'function',
                      legend: { position: 'bottom' },
                      vAxis: {
                        textStyle:{color: '#FFF'},
                        titleTextStyle:{color: '#FFF'},
                        gridlines: {color: '#787878'}
                      },
                      hAxis: {
                        textStyle:{color: '#FFF'},
                        titleTextStyle:{color: '#FFF'},
                        gridlines: {color: '#787878'}
                      }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                    chart.draw(data, options);
                }

            </script>
            
            
            <!-- Side Bar JavaScript -->
            <script src="../js/side-bar.js"> </script>   

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        </main>
    </body>
</html>