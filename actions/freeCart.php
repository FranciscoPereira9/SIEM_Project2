<?php
    session_start();
    $_SESSION['cart'] = array();
    header("Location: ../pages/cart.php")
?>