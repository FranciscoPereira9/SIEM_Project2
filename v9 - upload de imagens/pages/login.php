<!DOCTYPE HTML>
<head>
<title>Login</title>
</head>

<?php

	include_once "components/header.php";

 ?>

<body>
<h2>Autenticação</h2>

<form method="post" action="../actions/validar_login.php">
		<p><label for="username">Username:</label><input type="text" name="username"/> </p>
		<p><label for="password">Password:</label><input type="password" name="password"/> </p/>
		<p><input type="submit" value="Login" /> </p>
</form>

<?php
    //validar qual foi o erro que aconteceu
    if (isset($_GET["erro"])) {
        $msg_erro = "";
        switch ($_GET["erro"]) {
            case 1:
                $msg_erro = "Erro. username ou password inexistente.";
                break;
            //Neste switch poderão ser acrescentadas mais mensagens de erro
        }

        if ($msg_erro != "")
            echo "<h3>$msg_erro</h3>";
    }

		echo "Username: username; Password: password";
?>

</body>
</html>
