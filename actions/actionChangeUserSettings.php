<?php
session_start();

include_once "../includes/opendb.php";
include_once "../database/db_user.php";

//change account settings
if(!empty($_POST['save_changes_account'])){
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$password=md5($_POST['password']);
	$phone=$_POST['phone'];
	//echo $_SESSION['email'];
	//echo $_SESSION['username'];
	if(!empty($firstname)){
		updateFirstname($_SESSION['email'], $firstname);
	}
	if(!empty($lastname)){
		updateLastname($_SESSION['email'], $lastname);
	}
	if(!empty($password)){
		updatePassword($_SESSION['email'], $password);
	}
	if(!empty($phone)){
		updatePhone($_SESSION['email'], $phone);
	}
}
//change payment settings
if(!empty($_POST['save_changes_payment'])){
	$payment = $_POST['payment'];
	if(!empty($payment)){
		updatePayment($_SESSION['email'], $payment);
	}
}
//change shipping settings
if(!empty($_POST['save_changes_shipping'])){
	$address = $_POST['address'];
	$postalcode = $_POST['postalcode'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	if(!empty($address)){
		updateAddress($_SESSION['email'], $address);
	}
	if(!empty($postalcode)){
		updatePostalcode($_SESSION['email'], $postalcode);
	}
	if(!empty($city)){
		updateCity($_SESSION['email'], $city);
	}
	if(!empty($country)){
		updateCountry($_SESSION['email'], $country);
	}
}
// echo empty($_POST['firstname']);
// echo $_POST['payment'];
// echo $_POST['postalcode'];
header("Location: ../pages/user.php");
?>