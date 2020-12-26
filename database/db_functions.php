<html>

<?php

// Connect to DB
//$conn = pg_connect("host=db.fe.up.pt dbname=siem2053 user=siem2053 password=EIscKFUh");

    
    //Function to get all orders -> returns Array with all results
    function get_db_orders($conn){
      $query = "SELECT * FROM \"tp_php\".orders;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
        
      return $arr;
    }

    //Function to get all users -> returns Array with all results
    function get_db_users($conn){
      $query = "SELECT * FROM \"tp_php\".user;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
      
      return $arr;
    }

    //Function to get all products -> returns Array with all products
    function get_db_products($conn){
      $query = "SELECT * FROM \"tp_php\".product;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
      
      return $arr;
    }

    // Get specific order
    function get_order($conn, $order_id){
      $query = "SELECT * 
                FROM \"tp_php\".orders
                WHERE order_id = '".$order_id."';";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
        
      return $arr;
    }


    //Function to add product to DB
    function add_product($conn, $product_name, $ean, $quantity, $category, $brand, $color, $price, $image) {
      $stock = 0;
      $query = "INSERT INTO \"tp_php\".products(name, ean, stock, category, brand, color, price, img) VALUES ('".$product_name."', '".$ean."', '".($quantity)."', '".$category."', '".$brand."', '".$color."', '".$price."', '".$image."' );";

      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }


    }

    //Function to update stock
    function add_stock($conn, $ean, $quantity){
      //Get product to add stock
      $query = "SELECT stock 
                FROM \"tp_php\".products
                WHERE ean = '".$ean."';";

      $res = pg_exec($conn, $query);
      if (!$res) {
        echo "An error occurred.\n";
        exit;
      }
      $res = pg_fetch_row($res);

      //Get how much it has
      $prev_stock = $res[0];
      $new_stock = $prev_stock + $quantity;

      //Add quantity to what it has
      $query = "UPDATE \"tp_php\".products
                SET stock='".$new_stock."'
                WHERE ean='".$ean."';";

       $res = pg_exec($conn, $query);
       if (!$res) {
         echo "An error occurred.\n";
         exit;
       }

    } 


    //Function to get number of clients
    function n_customers($conn){

      $query = "SELECT COUNT(id) FROM \"tp_php\".user;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }

      
      return pg_fetch_row($res);
    }

    //Function to get total revenue in sales
    function revenue_sales($conn){

      $query = "SELECT SUM(total_order_price)
                FROM (
                  SELECT DISTINCT order_id,total_order_price 
                  FROM \"tp_php\".orders) as t;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }

      
      return pg_fetch_row($res);
    }

    //Function to get avg cart in sales
    function avg_cart($conn){

      $query = "SELECT AVG(total_order_price)
                FROM (
                  SELECT DISTINCT order_id,total_order_price 
                  FROM \"tp_php\".orders) as t;";

      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }

      
      return pg_fetch_row($res);
    }


    // Display array of values
    function display_arr($arr){
      foreach($arr as $n){
        foreach($n as $key=>$value){
          print "$key holds $value |";
        }
        echo "<br>";
      }
    }

    // Function to get percentage of sales per category


?>
</html>