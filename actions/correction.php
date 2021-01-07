<?php
    session_start();
    //$_SESSION['username']="admin";
    //$_SESSION['password']="admin";
    $destroy = session_destroy();
    if($destroy) echo "success";
    //session_unset();
?>