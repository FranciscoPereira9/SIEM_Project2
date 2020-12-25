<?php
    //TODO: verificar se email já existe
    session_start();

    include_once "../includes/opendb.php";
    include_once "../database/user.php";
    echo empty($_POST['OK']);
    if (!empty($_POST['OK'])){
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
            $_SESSION['msgErro'] = "Erro nos formulário (um dos campos em falta)<p>";

            //inserir dados em falta no formulário para aparecer
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email_signin'] = $email;
            $_SESSION['password_signing'] = $password;

            header("Location: ../pages/user.php");
        }
        else {
			
			
			//Se dados válidos, a query é executada e depois o script é redirecionado para a página de entrada
			$result = createUser($firstname, $lastname, $email, $password_md5);

		    header("Location: ../pages/user.php");
		
	    }
			
    }
?>