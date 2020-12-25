<?php
	session_start();
	
?>
<html>
	<body>
		<h3> INSERT USER </h3>
		
		<b>INSERT NEW USER:</b><br><br>
		<?php 
			if(isset($_SESSION['msgErro'])){
	 		echo $_SESSION['msgErro'];
		}
		?>

		<form method="POST" action="../actions/actionCreateUser.php">
		
		Firstname: 	<input type="text" name="firstname"></input><br>
		Lastname: 	<input type="text" name="lastname"></input><br>
		   Login: 	<input type="text" name="email"></input><br>
		Password: 	<input type="password" name="password"></input><br>
					<input type="submit" name="OK" value="OK"></input><br>
		</form>
	</body>
</html>
	