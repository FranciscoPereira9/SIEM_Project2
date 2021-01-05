<?php
include '../database/db_functions.php';
include '../includes/opendb.php';

$output="";
if(isset($_POST['action']))
{
    $query = "SELECT * 
            FROM \"tp_php\".orders";

    $first = true;// Variable to check if it's the first to append -> doesn't have AND
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
        else{$query .= "AND city IN('".$city."')";}
    }
    // Status restrictions
    if(isset($_POST["order_status"]) && !empty($_POST["order_status"]))
    {
        $status = $_POST["order_status"];
        if($first){$query .= "WHERE order_status IN('".$status."')";$first = false;}
        else{$query .= "AND order_status IN('".$status."')";}
    }

    $result_array = query_execute($conn,$query);
    if(!empty($result_array))
    {
        foreach($result_array as $n){
            $output .= "<tr>
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
    else {
        $output .='<h3>No Data Found</h3>';
    }
 echo $output;
}
else{
    $query = "SELECT * 
              FROM \"tp_php\".orders";
    $result_array = query_execute($conn,$query);
    foreach($result_array as $n){
        $output .= "<tr>
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
    echo $output;

}

?>