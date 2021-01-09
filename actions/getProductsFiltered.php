<?php
 include '../database/db_functions.php';
 include '../includes/opendb.php';

// Get the q parameter from URL
$q = $_REQUEST["q"];
// Get all products from DB
$arr = get_db_products($conn);
// Lookup all products from array (if $q is different from ""), that contain $q
if ($q !== "") {
    $arr = get_db_products_filtered($conn, $q);
}
// Print orders
display_products_table($arr);

// Function to display products table
function display_products_table($arr) {
    foreach($arr as $n){
        print("<tr>");
        print("<th scope=\"row\">".$n['sku']."</th>");
        print("<td>");
        echo $n['name'];
        print("</td>");
    
        print("<td>");
        echo $n['brand'];
        print("</td>");
    
        print("<td>");
        echo $n['price'];
        print("</td>");
    
        print("</tr>");
      }
}

?>