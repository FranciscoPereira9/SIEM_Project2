<?php
    include '../database/db_functions.php';
    include '../includes/opendb.php';
    session_start();
    // Get the POST action and check if set
    if(isset($_POST['action'])){
        // Set quantity
        $quantity = $_POST['quantity']; 
        $_SESSION['cart'][$_POST['item']]['quantity']= $quantity;
        $output = $quantity*$_SESSION['cart'][$_POST['item']]['price'];
        // Output
        echo "<b>".$output." €</b>";
    }

?>