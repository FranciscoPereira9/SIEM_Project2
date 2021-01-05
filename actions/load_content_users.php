<?php
//----------------- Not Being Used ---------------------------
function load_users_table($conn) {
    $arr = get_db_users($conn);
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
    
        print("</tr>");
      }
}
//----------------- Not Being Used ---------------------------
?>