<?php
 include '../database/db_functions.php';
 include '../includes/opendb.php';

// Get the q parameter from URL
$q = $_REQUEST["q"];
// Get all orders from DB
$arr = get_db_orders($conn);
// Lookup all orders from array (if $q is different from ""), that contain $q
if ($q !== "") {
    $arr = get_db_orders_filtered($conn, $q);
}

// Print orders
display_orders_table($arr);

// Function to display orders table
function display_orders_table($arr) {
    $output = "";
    foreach($arr as $n){
        $output .= "<tr>
        <th scope=\"row\">".$n['order_id']."</th>
        <td>".$n['date']."</td>
        <td>".$n['first_name']." ".$n['last_name']."</td>
        <td>".$n['order_status']."</td>
        <td>".$n['payment_method']."</td>
        <td>".$n['destination']."</td>
        <td>".$n['city']."</td>
        <td>".$n['name']."</td>
        <td>".$n['brand']."</td>
        <td>".$n['product_price']." €</td>
        <td>".$n['total_order_price']." €</td>
        </tr>"; 
      }
    echo $output;
}

?>