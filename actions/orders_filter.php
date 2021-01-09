<?php
include '../database/db_functions.php';
include '../includes/opendb.php';

$output="";
// Check if json action is set
if(isset($_POST['action']))
{
    // Query to get all orders related information
    $query =   "SELECT *
                FROM \"tp_php\".orders as orders
                    JOIN \"tp_php\".customers as customers
                    ON orders.client = customers.id 
                    JOIN \"tp_php\".products as products
                    ON orders.product = products.sku";

    $first = true; // Variable to check if it's the first query to append -> if it is, doesn't have AND
    // Min Max price restrictions
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]))
    {
        if($first){ $query .= " WHERE total_order_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'"; $first = false;}
        else{ $query .= "AND total_order_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";}
    }
    // City restrictions
    if(isset($_POST["city"]) && !empty($_POST["city"]))
    {
        $city = $_POST["city"];
        if($first){$query .= "WHERE city IN('".$city."')";$first = false;}
        else{$query .= "AND orders.city IN('".$city."')";}
    }
    // Status restrictions
    if(isset($_POST["order_status"]) && !empty($_POST["order_status"]))
    {
        $status = $_POST["order_status"];
        if($first){$query .= "WHERE order_status IN('".$status."')";$first = false;}
        else{$query .= "AND order_status IN('".$status."')";}
    }

    // Execute query
    $result_array = query_execute($conn,$query);
    // output orders found according to filter options
    if(!empty($result_array))
    {
        foreach($result_array as $n){
            $output .= "<tr>
            <th scope=\"row\">".$n['order_id']."</th>
            <td>".$n['date']."</td>
            <td>".$n['first_name']." ".$n['last_name']."</td>
            <td>".$n['order_status']."</td>
            <td>".$n['payment_method']."</td>
            <td>".$n['destination']."</td>
            <td>".$n['postcode']."</td>
            <td>".$n['city']."</td>
            <td>".$n['name']."</td>
            <td>".$n['brand']."</td>
            <td>".$n['product_price']." €</td>
            </tr>";         
        }
    }
    else {
        $output .='<h3>No Data Found</h3>';
    }
 echo $output;
}
else{
    // Output all orders if no filter restrictions
    $query =   "SELECT *
                FROM \"tp_php\".orders as orders
                    JOIN \"tp_php\".customers as customers
                    ON orders.client = customers.id 
                    JOIN \"tp_php\".products as products
                    ON orders.product = products.sku";

    $result_array = query_execute($conn,$query);
    foreach($result_array as $n){
        $output .= "<tr>
        <th scope=\"row\">".$n['order_id']."</th>
        <td>".$n['date']."</td>
        <td>".$n['first_name']." ".$n['last_name']."</td>
        <td>".$n['order_status']."</td>
        <td>".$n['payment_method']."</td>
        <td>".$n['destination']."</td>
        <td>".$n['postcode']."</td>
        <td>".$n['city']."</td>
        <td>".$n['name']."</td>
        <td>".$n['brand']."</td>
        <td>".$n['product_price']." €</td>
        </tr>";  
    }
    echo $output;

}

?>