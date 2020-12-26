<?php
	session_start();
	
?>
<html>
	<body>
		<h3> USER</h3>
		<?php 
			if(isset($_SESSION['signinSuccess'])){
	 			echo $_SESSION['signinSuccess'];
				$_SESSION['signinSuccess'] = NULL;
			}
		?>

		<b>LOGIN:</b><br><br>
		<form method="POST" action="../actions/actionLogIn.php">
		   Login: 	<input type="text" name="email_login"></input><br>
		Password: 	<input type="password" name="password_login"></input><br>
					<input type="submit" name="login" value="LOGIN"></input><br>
		</form>
		
		<b>SIGN IN:</b><br><br>
		<?php 
			if(isset($_SESSION['signinIncomplete'])){
	 			echo $_SESSION['signinIncomplete'];
				$_SESSION['signinIncomplete']=NULL;
			}
			if(isset($_SESSION['signinUserFail'])){
	 			echo $_SESSION['signinUserFail'];
				$_SESSION['signinUserFail']=NULL;
			}
		?>

		<form method="POST" action="../actions/actionCreateUser.php">
		
		Firstname: 	<input type="text" name="firstname"></input><br>
		Lastname: 	<input type="text" name="lastname"></input><br>
		   Login: 	<input type="text" name="email"></input><br>
		Password: 	<input type="password" name="password"></input><br>
					<input type="submit" name="register" value="REGISTER"></input><br>
		</form>
	</body>
</html>
	