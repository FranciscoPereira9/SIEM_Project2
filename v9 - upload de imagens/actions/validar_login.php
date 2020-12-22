<?php
session_start();

include_once "../includes/opendb.php";
include_once "../database/user.php";

if (isset($_POST["username"], $_POST["password"])) {
    $user = $_POST["username"];

    //A encriptação da password para contactar com a bass de dados
    $pass = md5($_POST["password"]);

    $user = loadByUsernameAndPassword($user, $pass);

    if ($user == NULL) {
        header("Location: ../pages/login.php?erro=1");
    } else{
        $_SESSION['username'] = $user;
        header("Location: ../pages/listCities.php");
    }
  }
else {
  header("Location: ../pages/login.php?erro=2");
}


?>
