<?php
 include '../database/db_functions.php';
 include '../includes/opendb.php';

// Get the q parameter from URL
$q = $_REQUEST["q"];
$arr = get_db_orders($conn);
// Lookup all users from array if $q is different from ""
if ($q !== "") {
    $arr = get_db_orders_filtered($conn, $q);
}
// Print orders
display_orders_table($arr);

function display_orders_table($arr) {
    foreach($arr as $n){
        echo "<tr>
        <th scope=\"row\">".$n['order_id']."</th>
        <td>".$n['date']."</td>
        <td>".$n['order_status']."</td>
        <td>".$n['client']."</td>
        <td>".$n['destination']."</td>
        <td>".$n['postcode']."</td>
        <td>".$n['city']."</td>
        <td>".$n['product_price']."</td>
        </tr>"; 
      }
}

?>