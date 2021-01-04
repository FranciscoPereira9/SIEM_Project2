<?php

// Connect to DB
//$conn = pg_connect("host=db.fe.up.pt dbname=siem2053 user=siem2053 password=EIscKFUh");

    // ---------------------------------- Orders Related ----------------------------------------

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

    //  Total revenue in sales
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

    // Average cart in sales
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

    // Chart Data -> Orders per date
    function chart_data($conn){
      $query = "SELECT date, sum(price)
                FROM (
                  SELECT *
                  FROM orders
                  LEFT JOIN products ON orders.product=products.sku) AS t
                GROUP BY date
                ORDER BY date ASC";
      
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }

      $arr = pg_fetch_all($res);
      
      return $arr;

    }


    // ---------------------------------- Users Related ----------------------------------------

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

    // Searches word on all attributes of user
    function get_db_users_filtered($conn,$word){
      $query = "SELECT * FROM \"tp_php\".user
                WHERE first_name LIKE '%".$word."%' OR last_name LIKE '%".$word."%' OR email LIKE '%".$word."%' OR address LIKE '%".$word."%'
                OR country LIKE '%".$word."%' OR city LIKE '%".$word."%' OR phone LIKE '%".$word."%' OR postalcode LIKE '%".$word."%';";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
      
      return $arr;
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


    // ---------------------------------- Products Related ----------------------------------------

    //Function to get all products -> returns Array with all products
    function get_db_products($conn){
      $query = "SELECT * FROM \"tp_php\".products;";
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
          throw new Exception('Something went wrong. Coudn\'t add item to database.');
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

    // Get all Brands in Store
    function distinct_brands($conn) {
      $query = "SELECT DISTINCT brand FROM \"tp_php\".products;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
      
      return $arr;
    }

    // Get all Categories in Store
    function distinct_categories($conn) {
      $query = "SELECT DISTINCT category FROM \"tp_php\".products;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
      
      return $arr;
      
    }

    // Get all Product Colour's in Store
    function distinct_colors($conn) {
      $query = "SELECT DISTINCT color FROM \"tp_php\".products;";
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
      
      return $arr;
    }


    
    // ---------------------------------- Others ----------------------------------------
    // Display array of values
    function display_arr($arr){
      foreach($arr as $n){
        foreach($n as $key=>$value){
          print "$key holds $value |";
        }
        echo "<br>";
      }
    }

    //Execute query
    function query_execute($conn,$query){
      $res = pg_exec($conn, $query);
      if (!$res) {
          echo "An error occurred.\n";
          exit;
        }
      $arr = pg_fetch_all($res);
        
      return $arr;
    }



?>