<?php

//cria novo utilizador
function createUser($firstname, $lastname, $email, $password_md5){

	global $conn;
	//$firstname = $_POST['firstname'];
	//$lastname = $_POST['lastname'];
	//$email = $_POST['email'];
	//$password = $_POST['password'];
	//$password_md5 = md5($password);
			
	//$conn = pg_connect("host=db.fe.up.pt dbname=siem2053 user=siem2053 password=EIscKFUh");

			
	$query = "INSERT INTO \"tp_php\".user (first_name, last_name, email, password) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password_md5."');";

	pg_exec($conn, $query);
	
	return NULL;
}

//verifica se email já é utlizado por algum utilizador na base de dados
function checkEmail($email){
	global $conn;

	$query = "SELECT * FROM \"tp_php\".user WHERE email='".$email."';";

	$result = pg_exec($conn, $query);

	$num_registos = pg_numrows($result);

	if($num_registos==0){
		return 0;
	}
	else{
		return 1;
	}

}

//verifica utilizador e password para fazer login
function checkUserPassword($user, $password){
	global $conn;

	$password_md5 = md5($password);

	$query = "SELECT * FROM \"tp_php\".user WHERE email='".$user."' AND password='".$password_md5."';";

	$result = pg_exec($conn, $query);

	$num_registos = pg_numrows($result);
	
	$login = pg_fetch_row($result, 0);
	

	if($num_registos>0){
		return $login[1];
	}
	else{
		return 0;
	}
}

function updateFirstname($email, $first_name){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET first_name='".$first_name."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updateLastname($email, $last_name){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET last_name='".$last_name."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}


function updatePassword($email, $password){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET password='".$password."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updatePhone($email, $phone){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET phone='".$phone."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updatePayment($email, $payment){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET payment_method='".$payment."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updateAddress($email, $address){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET address='".$address."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updatePostalcode($email, $postalcode){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET postalcode='".$postalcode."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updateCity($email, $city){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET city='".$city."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function updateCountry($email, $country){
	global $conn;
	
	$query = "UPDATE \"tp_php\".user SET country='".$country."' WHERE email='".$email."';";
	
	pg_exec($conn, $query);
	
	return NULL;
}

function debugUser($password){
	global $conn;
	
	$password=md5($password);
	$query = "UPDATE \"tp_php\".user SET password='".$password."' WHERE email='user';";
	
	pg_exec($conn, $query);
	
	return NULL;
}
?>

	