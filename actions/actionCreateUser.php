<?php
    session_start();

    include_once "../includes/opendb.php";
    include_once "../database/db_user.php";
    if (!empty($_POST['register'])){
        $firstname = $_POST['firstname'];
	    $lastname = $_POST['lastname'];
	    $email = $_POST['email'];
	    $password = $_POST['password'];
	    $password_md5 = md5($password);

        //Validação dos dados
        if (empty($firstname) || empty($lastname) || empty($email) ||  empty($password)){
			
			$dadosValidos = false;
            echo $dadosValidos;
			}
		else {
			$dadosValidos = true;
		}

        //construção da query ou mensagem de erro
        if(!$dadosValidos){
            $_SESSION['signupIncomplete'] = "* All fields are required!";

            //inserir dados em falta no formulário para aparecer
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email_signin'] = $email;
            $_SESSION['password_signing'] = $password;

            header("Location: ../pages/user.php");
        }
        else {
			//Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada
			if(checkEmail($email)==0){
			    createUser($firstname, $lastname, $email, $password_md5);
                $_SESSION['signupSuccess'] = "Account created!";
            }else{
                $_SESSION['signupUserFail'] = "* User already in use!";
            }
			

		    header("Location: ../pages/user.php");
		
	    }
			
    }
?>