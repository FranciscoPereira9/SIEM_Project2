<?php
    session_start();

    include_once "../includes/opendb.php";
    include_once "../database/user.php";
    if (!empty($_POST['login'])){
	    $email = $_POST['email_login'];
	    $password = $_POST['password_login'];
	    $password_md5 = md5($password);

        //Validação dos dados
        if (empty($email) ||  empty($password)){
			
			$dadosValidos = false;
            echo $dadosValidos;
			}
		else {
			$dadosValidos = true;
		}

        //construção da query ou mensagem de erro
        if(!$dadosValidos){
            $_SESSION['msgErroLogin'] = "Wrong username/password<p>";

            //inserir dados no formulário para alterar
            $_SESSION['email_error'] = $email;

            header("Location: ../pages/user.php");
        }
        else {
			
            //Verifica se login é válido
			$login = checkUserPassword($email, $password);

            if($login==0){
                $_SESSION['msgErroLogin'] = "Wrong username/password<p>";
            }
            else{
                $_SESSION['msgErroLogin'] = $email;
            }

		    header("Location: ../pages/user.php");
		
	    }
			
    }
?>