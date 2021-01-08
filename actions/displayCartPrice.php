<?php
    include '../database/db_functions.php';
    include '../includes/opendb.php';
    session_start();
    // Get the POST action

    if(isset($_POST['action'])){
        // Set quantity
        $quantity = $_POST['quantity']; 
        $_SESSION['cart'][$_POST['item']]['quantity']= $quantity;
        $output = $quantity*$_SESSION['cart'][$_POST['item']]['price'];
        
        echo "<b>".$output." €</b>";
    }

?>