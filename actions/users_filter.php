<?php
include '../database/db_functions.php';
include '../includes/opendb.php';

$output="";
// Check if json action is set
if(isset($_POST['action']))
{
    // Query to get all users related information
    $query = "SELECT * 
            FROM \"tp_php\".customers";


    $first = true; // Variable to check if it's the first query to append -> if it is, doesn't have AND
    // Min Max price restrictions
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]))
    {
        if($first){ $query .= " WHERE total_spent BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'"; $first = false;}
        else{ $query .= "AND total_spent BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";}
    }
    // country restrictions
    if(isset($_POST["country"]) && !empty($_POST["country"]))
    {  
        $country = $_POST["country"];
        if($first){$query .= " WHERE country IN('".$country."') ";$first = false;}
        else{$query .= "AND country IN('".$country."') ";}
    }
    // Color restrictions
    if(isset($_POST["city"]) && !empty($_POST["city"]))
    {
        $city = $_POST["city"];
        if($first){$query .= "WHERE city IN('".$city."')";$first = false;}
        else{$query .= "AND city IN('".$city."')";}
    }

    // Execute query
    $result_array = query_execute($conn,$query);
    // output users found according to filter options
    if(!empty($result_array))
    {
        foreach($result_array as $n){
            $output .= "<tr>
            <th scope=\"row\">".$n['id']."</th>
            <td>".$n['first_name']."</td>
            <td>".$n['last_name']."</td>
            <td>".$n['email']."</td>
            <td>".$n['phone']."</td>
            <td>".$n['country']."</td>
            <td>".$n['city']."</td>
            <td>".$n['address']."</td>
            <td>".$n['postalcode']."</td>
            <td>".$n['total_spent']." €</td>
            </tr>";         
        }
    }
    else {
        $output .='<h3>No Data Found</h3>';
    }
 echo $output;
}
else{
    // Output all users if no filter restrictions
    $query = "SELECT * 
              FROM \"tp_php\".customers";
    $result_array = query_execute($conn,$query);
    foreach($result_array as $n){
        $output .= "<tr>
            <th scope=\"row\">".$n['id']."</th>
            <td>".$n['first_name']."</td>
            <td>".$n['last_name']."</td>
            <td>".$n['email']."</td>
            <td>".$n['phone']."</td>
            <td>".$n['country']."</td>
            <td>".$n['city']."</td>
            <td>".$n['address']."</td>
            <td>".$n['postalcode']."</td>
            <td>".$n['total_spent']." €</td>
            </tr>";           
    }
    echo $output;

}

?>