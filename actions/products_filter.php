<?php
include '../database/db_functions.php';
include '../includes/opendb.php';

$output="";
// Check if json action is set
if(isset($_POST['action']))
{
    // Query to get all products related information
    $query = "SELECT * 
            FROM \"tp_php\".products";

    $first = true; // Variable to check if it's the first query to append -> if it is, doesn't have AND
    // Min Max price restrictions
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]))
    {
        if($first){ $query .= " WHERE price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'"; $first = false;}
        else{ $query .= "AND price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";}
    }
    // Category restrictions
    if(isset($_POST["category"]) && !empty($_POST["category"]))
    {  
        $category = $_POST["category"];
        if($first){$query .= " WHERE category IN('".$category."') ";$first = false;}
        else{$query .= "AND category IN('".$category."') ";}
    }
    // Color restrictions
    if(isset($_POST["color"]) && !empty($_POST["color"]))
    {
        $color = $_POST["color"];
        if($first){$query .= "WHERE color IN('".$color."')";$first = false;}
        else{$query .= "AND color IN('".$color."')";}
    }
    // Brand restrictions
    if(isset($_POST["brand"]) && !empty($_POST["brand"]))
    {
        $brand = $_POST["brand"];
        if($first){$query .= "WHERE brand IN('".$brand."') ";$first = false;}
        else{$query .= "AND brand IN('".$brand."') ";}
    }

    // Execute query
    $result_array = query_execute($conn,$query);
    // output products found according to filter options
    if(!empty($result_array))
    {
        foreach($result_array as $n){
            $output .= "<tr>
            <th scope=\"row\">".$n['sku']."</th>
            <td>".$n['name']."</td>
            <td>".$n['brand']."</td>
            <td>".$n['price']." €</td>
            </tr>";         
        }
    }
    else {
        $output .='<h3>No Data Found</h3>';
    }
 echo $output;
}
else{
    // Output all products if no filter restrictions
    $query = "SELECT * 
              FROM \"tp_php\".products";
    $result_array = query_execute($conn,$query);
    foreach($result_array as $n){
        $output .= "<tr>
        <th scope=\"row\">".$n['sku']."</th>
        <td>".$n['name']."</td>
        <td>".$n['brand']."</td>
        <td>".$n['price']." €</td>
        </tr>";         
    }
    echo $output;

}

?>