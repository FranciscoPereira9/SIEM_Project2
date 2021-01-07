<?php
 include '../database/db_functions.php';
 include '../includes/opendb.php';

// Get the q parameter from URL

$q = $_REQUEST["q"];
$arr = get_db_women_products($conn);
// Lookup all users from array if $q is different from ""
if ($q !== "") {
    $arr = get_db_women_products_filtered($conn, $q);
}

// Print orders
display_women_products($arr);

// Function to display table
function display_women_products($arr) {
    $output = "";
    foreach($arr as $row){
        $output .= "
        <div class=\"flex-element\">
            <a href=\"product.php?id=".$row['ean']."&gender=Women\"><img src=\"../images/products/Women/".$row['category']."/".$row['img'].".jpg\"></a><br>
            <a href=\"product.php?id=".$row['ean']."&gender=Women\">".$row['name']."</a><br>
            <p><b>".$row['price']." €</b></p>
        </div>"; 
      }
    echo $output;
}

?>