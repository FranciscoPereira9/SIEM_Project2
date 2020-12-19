<html>
	<body>
		<h3> INSERT USER </h3>
		
		<?php
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$password_md5 = md5($password);
			
			$conn = pg_connect("host=db.fe.up.pt dbname=siem2053 user=siem2053 password=EIscKFUh");
			$query = "set schema 'tp_php'";
			pg_exec($conn, $query);
			
			$query = "INSERT INTO \"tp_php\".user (first_name, last_name, email, password) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password_md5."');";
			echo $query;
			pg_exec($conn, $query);
		?>
	</body>
</html>
	