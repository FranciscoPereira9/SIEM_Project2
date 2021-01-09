<?php
include '../database/db_functions.php';
include '../includes/opendb.php';

$output="";
// Get gender
$gender = $_POST['gender'];
// Check if json action is set
if(isset($_POST['action']))
{
    // Query to get all producst according to gender
    $query = "SELECT * 
            FROM \"tp_php\".products
            WHERE gender = '".$gender."'";

    $first = false;// Variable to check if it's the first to append -> doesn't have AND
    // Min Max price restrictions
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]))
    {
        if($first){ $query .= " WHERE price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'"; $first = false;}
        else{ $query .= " AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";}
    }
    // Category restrictions
    if(isset($_POST["category"]) && !empty($_POST["category"]))
    {  
        $category = $_POST["category"];
        if($first){$query .= " WHERE category IN('".$category."')";$first = false;}
        else{$query .= " AND category IN('".$category."')";}
    }
    // Color restrictions
    if(isset($_POST["color"]) && !empty($_POST["color"]))
    {
        $color = $_POST["color"];
        if($first){$query .= " WHERE color IN('".$color."')";$first = false;}
        else{$query .= " AND color IN('".$color."')";}
    }
    // Brand restrictions
    if(isset($_POST["brand"]) && !empty($_POST["brand"]))
    {
        $brand = $_POST["brand"];
        if($first){$query .= " WHERE brand IN('".$brand."')";$first = false;}
        else{$query .= " AND brand IN('".$brand."')";}
    }
    
    $query.=" ORDER BY ean;";
    // Execute query
    $result_array = query_execute($conn,$query);
    // display products found according to filter options
    if(!empty($result_array))
    {
        // Check if repeated ean (in case of products with different colors) and don't print
        $last_ean = "";
        foreach($result_array as $row){
            if($row['ean']!=$last_ean){            
                $output .= "
                <div class=\"flex-element\">
                    <a href=\"product.php?id=".$row['ean']."&gender=".$gender."\"><img src=\"../images/products/".$gender."/".$row['category']."/".$row['img'].".jpg\"></a><br>
                    <a href=\"product.php?id=".$row['ean']."&gender=".$gender."\">".$row['name']."</a><br>
                    <p><b>".$row['price']." €</b></p>
                </div>";   
            } 
            $last_ean=$row['ean'];     
        }
    }
    else {
        $output .='<h3>No Data Found</h3>';
    }
 echo $output;
}
else{
    // Output all products if no filter restrictions according to gender
    $query = "SELECT * 
              FROM \"tp_php\".products";
    $query.=" ORDER BY ean;";
    // Execute query
    $result_array = query_execute($conn,$query);
    // display products found according to filter options
    $last_ean = "";    
    foreach($result_array as $row){
        // Check if repeated ean (in case of products with different colors) and don't print
        if($row['ean']!=$last_ean){
            $output .= "
                <div class=\"flex-element\">
                    <a href=\"product.php?id=".$row['ean']."&gender=".$gender."\"><img src=\"../images/products/".$gender."/".$row['category']."/".$row['img'].".jpg\"></a><br>
                    <a href=\"product.php?id=".$row['ean']."&gender=".$gender."\">".$row['name']."</a><br>
                    <p><b>".$row['price']." €</b></p>
                </div>";          
        }
        $last_ean=$row['ean']; 
    }
    echo $output;

}

?>