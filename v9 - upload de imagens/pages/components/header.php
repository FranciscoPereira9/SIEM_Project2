
<head>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
	<ul>
		<li id="left-element"><a  href="listCities.php">Cidades</a></li>
		<?php
		//Contrução do Header de forma dinâmica tendo em conta se o utilizador tem sessão iniciada
		if(!isset($_SESSION['username'])){ ?>
			<li><a href="login.php"> Login</a></li>
		<?php } else{
      //Mostra o link para fazer logout sempre que tem login válido
      echo "<li><a href='../actions/actionLogout.php'> Logout</a></li>";
      echo "<li>Olá " . $_SESSION['username'] ."!</li>";

		}?>
	</ul>
