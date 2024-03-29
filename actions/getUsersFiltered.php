<?php
 include '../database/db_functions.php';
 include '../includes/opendb.php';

// Get the q parameter from URL
$q = $_REQUEST["q"];
// Get all users from DB
$arr = get_db_users($conn);
// Lookup all users from array if $q is different from ""
if ($q !== "") {
    $arr = get_db_users_filtered($conn, $q);
}

// Print orders
display_users_table($arr);

// Function to display users table
function display_users_table($arr) {
    foreach($arr as $n){
        print("<tr>");
        print("<th scope=\"row\">".$n['id']."</th>");
        print("<td>");
        echo $n['first_name'];
        print("</td>");
    
        print("<td>");
        echo $n['last_name'];
        print("</td>");
    
        print("<td>");
        echo $n['email'];
        print("</td>");
    
        print("<td>");
        echo $n['phone'];
        print("</td>");
    
        print("<td>");
        echo $n['country'];
        print("</td>");
    
        print("<td>");
        echo $n['city'];
        print("</td>");
    
        print("<td>");
        echo $n['address'];
        print("</td>");
    
        print("<td>");
        echo $n['postalcode'];
        print("</td>");

        print("<td>");
        echo $n['total_spent'];
        print(" €</td>");
    
        print("</tr>");
      }
}

?>