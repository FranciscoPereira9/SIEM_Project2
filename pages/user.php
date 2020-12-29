<?php
	session_start();
	if(!isset($_SESSION['cart'])){
	$_SESSION['cart']=array();
}
if(!isset($_SESSION['username'])){
	$_SESSION['username']='';
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
?>
<html>
	<body>
		<h3> USER</h3>
		<?php 
			if($_SESSION['signinSuccess']!=''){
	 			echo $_SESSION['signinSuccess'];
				$_SESSION['signinSuccess'] = NULL;
			}
		
			if($_SESSION['username']!=''){
				?>
				<a href="../actions/actionLogout.php"> Logout </a>
				<?php
			}
			else{
				echo $_SESSION['username'];
				echo "<b>LOGIN:</b><br><br>";
				echo "<form method=\"POST\" action=\"../actions/actionLogIn.php\">";
				   echo"Login: 	<input type=\"text\" name=\"email_login\"></input><br>";
				echo"Password: 	<input type=\"password\" name=\"password_login\"></input><br>";
							echo"<input type=\"submit\" name=\"login\" value=\"LOGIN\"></input><br>";
				echo"</form>";
				
				echo"<b>SIGN IN:</b><br><br>";
				
					if($_SESSION['signupIncomplete']!=''){
						echo $_SESSION['signupIncomplete'];
						$_SESSION['signupIncomplete']=NULL;
					}
					if($_SESSION['signupUserFail']!=''){
						echo $_SESSION['signupUserFail'];
						$_SESSION['signupUserFail']=NULL;
					}
				

				echo "<form method=\"POST\" action=\"../actions/actionCreateUser.php\">";
				
				echo"Firstname: 	<input type=\"text\" name=\"firstname\"></input><br>";
				echo"Lastname: 	<input type=\"text\" name=\"lastname\"></input><br>";
				   echo"Login: 	<input type=\"text\" name=\"email\"></input><br>";
				echo"Password: 	<input type=\"password\" name=\"password\"></input><br>";
							echo"<input type=\"submit\" name=\"register\" value=\"REGISTER\"></input><br>";
				echo"</form>";
				
			}
		?>
	</body>
</html>
	