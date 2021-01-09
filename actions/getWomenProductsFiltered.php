<?php
 include '../database/db_functions.php';
 include '../includes/opendb.php';

// Get the q parameter from URL
$q = $_REQUEST["q"];
// Get women products from DB
$arr = get_db_women_products($conn);
// Lookup all products from array (if $q exists), where they have $q in it
if ($q !== "" && $q != 'null') {
    $arr = get_db_women_products_filtered($conn, $q);
}

// Print orders
display_women_products($arr);

// Function to display products according to search
function display_women_products($arr) {
    $last_ean="";
    $output = "";
    foreach($arr as $row){
        if($row['ean']!=$last_ean){
            $output .= "
            <div class=\"flex-element\">
                <a href=\"product.php?id=".$row['ean']."&gender=Women\"><img src=\"../images/products/Women/".$row['category']."/".$row['img'].".jpg\"></a><br>
                <a href=\"product.php?id=".$row['ean']."&gender=Women\">".$row['name']."</a><br>
                <p><b>".$row['price']." €</b></p>
            </div>"; 
        }
        $last_ean=$row['ean'];
    }
    echo $output;
}

?>