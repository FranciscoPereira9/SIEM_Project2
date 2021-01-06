<?php
	session_start();
	if(!isset($_SESSION['cart'])){
	$_SESSION['cart']=array();
}
if(!isset($_SESSION['username'])){
	$_SESSION['username']='';
}

if(!isset($_SESSION['email'])){
	$_SESSION['email']='';
}
if(!isset($_SESSION['signinSuccess'])){
	$_SESSION['signinSuccess']='';
}
if(!isset($_SESSION['signupIncomplete'])){
	$_SESSION['signupIncomplete']='';
}
if(!isset($_SESSION['signupUserFail'])){
	$_SESSION['signupUserFail']='';
}
if(!isset($_SESSION['checkoutError'] )){
	$_SESSION['checkoutError'] = '';
}

include_once "../includes/opendb.php";
include_once "../database/db_user.php";
?>
<html>
	<head>
		
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="../css/style-user.css" rel="stylesheet" >
		<!-- Bootstrap CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<script src="https://kit.fontawesome.com/3ab706ac58.js" crossorigin="anonymous"></script>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		
	</head>
	
	<body>
	<?php 
		include_once "components/header_background.php";
		include_once "components/side_bar.php";
	?>
	<div class="container1">
		<?php 
			if($_SESSION['signinSuccess']!=''){
	 			echo $_SESSION['signinSuccess'];
				$_SESSION['signinSuccess'] = '';
			}
			
		
			if($_SESSION['username']!=''){
				$details = getUserDetails($_SESSION['email']);
				
				?>
				<a href="../actions/actionLogout.php"> Logout </a>
				
				
				<div class="element">
				<p><b>Account:</b></p>
				
				<form method="POST" action="../actions/actionChangeUserSettings.php">
					<p>Firstname:<br> <input type="text" name="firstname"  value="<?php echo $details['first_name'];?>"><br></p>
					<p>Lastname:<br> <input type="text" name="lastname" value="<?php echo $details['last_name'];?>"><br></p>
					<p>Password:<br> <input type="password" name="password"><br></p>
					<p>Contact:<br> <input type="text" name="phone" value="<?php echo $details['phone'];?>"><br><br></p>
					<p><input type="submit" name="save_changes_account" value="Save"></p>
				</form>
				</div>
				
				
				<div class="element">
				<p><b>Payment:</b></p>
			
				<form method="POST" action="../actions/actionChangeUserSettings.php">
					<p><input type="radio" value="paypal" name="payment" <?php if ($details['payment_method']=='paypal'){echo "checked=\"checked\"";}?>> PayPal<br></p>
					<p><input type="radio" value="mbway" name="payment"<?php if ($details['payment_method']=='mbway'){echo "checked=\"checked\"";}?>> MBway<br></p>
					<p><input type="radio" value="credit_card" name="payment"<?php if ($details['payment_method']=='credit_card'){echo "checked=\"checked\"";}?>> Credit Card<br></p>
					<p><input type="radio" value="bitcoin" name="payment"<?php if ($details['payment_method']=='bitcoin'){echo "checked=\"checked\"";}?>> BitCoin<br><br></p>
					<p><input type="submit" name="save_changes_payment" value="Save"></p>
				</form>
				</div>	
				
				
				<div class="element">
				<p><b>Shipping</b></p>
			
				<form method="POST" action="../actions/actionChangeUserSettings.php">
					<p>Address:<br> <input type="text" name="address" value="<?php echo $details['address'];?>"><br></p>
					<p>Postal Code:<br> <input type="text" name="postalcode" value="<?php echo $details['postalcode'];?>"><br></p>
					<p>City: <br><input type="text" name="city" value="<?php echo $details['city'];?>"><br></p>
					<p>Country: <br><input type="text" name="country" value="<?php echo $details['country'];?>"><br><br></p>
					<p><input type="submit" name="save_changes_shipping" value="Save"></p>
				</form>
				</div>
				<?php
			}
			
			
			
			
			
			else{
				?>
				<div id="left">
				<div style="margin-bottom:20px"><?php
				echo $_SESSION['username'];
				echo "<p style=\"padding:10px\"><b>SIGN IN:</b><p>";
				if($_SESSION['checkoutError'] != ''){
					echo $_SESSION['checkoutError'];
					$_SESSION['checkoutError']  = '';
				}
				?>
				</div>
				<form method="POST" action="../actions/actionLogIn.php">
				<table>
				<tr><td>Login:</td><td><input type="text" name="email_login"></td></tr><br>
				<tr><td>Password:</td><td><input type="password" name="password_login"></td></tr><br>
				<tr><td><input type="submit" name="login" value="LOGIN"></td></tr>
				</table>
				</form>
				</div>
				<div id="right">
				<div style="margin-bottom:20px">
				<?php
				echo"<p style=\"padding:10px\"><b>SIGN UP:</b></p>";
				
					if($_SESSION['signupIncomplete']!=''){
						echo $_SESSION['signupIncomplete'];
						$_SESSION['signupIncomplete']='';
					}
					if($_SESSION['signupUserFail']!=''){
						echo $_SESSION['signupUserFail'];
						$_SESSION['signupUserFail']='';
					}
				echo "</div>";

				echo "<form method=\"POST\" action=\"../actions/actionCreateUser.php\">";
				echo "<table>";
				echo"<tr><td>Firstname:</td><td><input type=\"text\" name=\"firstname\"></td></tr>";
				echo"<tr><td>Lastname:</td><td><input type=\"text\" name=\"lastname\"></td></tr>";
				echo"<tr><td>Login:</td><td><input type=\"text\" name=\"email\"></td></tr>";
				echo"<tr><td>Password:</td><td><input type=\"password\" name=\"password\"></td></tr>";
				echo"<tr><td><input type=\"submit\" name=\"register\" value=\"REGISTER\"></input></td></tr>";
				echo "</table>";
				echo"</form>";
				echo"</div>";
				
			}
		?>
		
		
	</body>
</html>
	