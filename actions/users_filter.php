<?php
include '../database/db_functions.php';
include '../includes/opendb.php';

$output="";
if(isset($_POST['action']))
{
    $query = "SELECT * 
            FROM \"tp_php\".user";

    $first = true;// Variable to check if it's the first to append -> doesn't have AND
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

    $result_array = query_execute($conn,$query);
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
              FROM \"tp_php\".user";
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
            </tr>";           
    }
    echo $output;

}

?>