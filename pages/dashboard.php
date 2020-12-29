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
            </div>
      
            <h2>Dashboard</h2>
            <!-- Dashboard -->
            <div class= 'dashboard'>

              <!-- KPIs -->
              <div class="kpis">
                  <div class= "kpi1"> 
                    <h3>KPI1</h3>
                    <p>Sales</p>
                  </div>
                  <div class= "kpi2">
                    <h3>KPI2</h3>
                    <p>Average Cart</p>
                  </div>
                  <div class= "kpi3">
                    <h3>KPI3</h3>
                    <p>Clients</p>
                  </div>
              </div>
              <!-- Chart -->
              <div id="curve_chart" style="width: 100%; height: 600px" >
                  
              </div>
            
            </div>
            <!-- Google Charts JavaScript API -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Index', 'Sales'],
                    <?php
                      include '../includes/opendb.php';
                      include '../database/db_functions.php';

                      // Get data from db
                      $data = chart_data($conn);

                      $n = count($data);
                      $a = 0;
                      
                      foreach($data as $row){
                          
                          if($a < $n-1){
                              echo "[$a,".$row["sum"]."],\n";
                          }
                          else{
                              echo "[$a,".$row["sum"]."]";
                          }
                          $a++;
                      }
                    ?>    
                    ]);

                    var options = {
                      // title: 'none',
                      curveType: 'function',
                      legend: { position: 'bottom' }
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