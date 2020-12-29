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
		
			if($_SESSION['username']){
				?>
				<a href="../actions/actionLogout.php"> Logout </a>
				<?php
			}
			else{
				
				echo "<b>LOGIN:</b><br><br>";
				echo "<form method=\"POST\" action=\"../actions/actionLogIn.php\">";
				   echo"Login: 	<input type=\"text\" name=\"email_login\"></input><br>";
				echo"Password: 	<input type=\"password\" name=\"password_login\"></input><br>";
							echo"<input type=\"submit\" name=\"login\" value=\"LOGIN\"></input><br>";
				echo"</form>";
				
				echo"<b>SIGN IN:</b><br><br>";
				
					if(isset($_SESSION['signinIncomplete'])){
						echo $_SESSION['signinIncomplete'];
						$_SESSION['signinIncomplete']=NULL;
					}
					if(isset($_SESSION['signinUserFail'])){
						echo $_SESSION['signinUserFail'];
						$_SESSION['signinUserFail']=NULL;
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
	