<?php
 include_once '../database/db_functions.php';
 include_once '../includes/opendb.php';

// Get the q parameter from URL
$q = $_REQUEST["q"];
// Get men products from DB
$arr = get_db_men_products($conn);
// Lookup all products from array (if $q exists), where they have $q in it
if ($q !== "" && $q != 'null') {
    $arr = get_db_men_products_filtered($conn, $q);
}

// Print orders
display_men_products($arr);

// Function to display products according to search
function display_men_products($arr) {
    $last_ean="";
    $output = "";
    foreach($arr as $row){
        if($row['ean']!=$last_ean){
            $output .= "
            <div class=\"flex-element\">
                <a href=\"product.php?id=".$row['ean']."&gender=Men\"><img src=\"../images/products/Men/".$row['category']."/".$row['img'].".jpg\"></a><br>
                <a href=\"product.php?id=".$row['ean']."&gender=Men\">".$row['name']."</a><br>
                <p><b>".$row['price']." €</b></p>
            </div>"; 
        }
        $last_ean=$row['ean'];
      }
    echo $output;
}

?>