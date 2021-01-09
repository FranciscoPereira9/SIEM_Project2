<?php
	session_start();
	
	//INCLUDES PARA ACESSO A BD
	include '../database/db_functions.php';
	include '../includes/opendb.php';
	
	//VERIFICA SE BOTÃO FOI CARREGADO
	if(!empty($_POST['additem'])){
		
		//GUARDA TODOS OS DADOS DO FORMULÁRIO QUE CHAMOU ESTA ACTION
		$name=$_POST['product-name'];
		$price=$_POST['product-price'];
		$category=$_POST['product-category'];
		$brand=$_POST['product-brand'];
		$ean=$_POST['product-ean'];
		$quantity=$_POST['product-quantity'];
		$color=$_POST['color'];
		$gender=$_POST['gender'];
		
		
		
		
		//VALIDAR IMAGEM A DAR UPLOAD:
		
		
		
		//CAMINHO PARA O DIRETÓRIO NO QUAL SE FARÁ UPLOAD
		$target_dir = "../images/products/$gender/$category/";
		//GUARDA CAMINHO DO FICHEIRO PARA UPLOAD
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		//FLAG PARA INDICAR SE SUCESSO (MAIS USADA NO FIM DO CÓDIGO)
		$uploadOk = 1;
		//VAI BUSCAR INFORMAÇÃO DO FICHEIRO (SE É JPG, JPEG, PNG...)
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		//VERIFICA SE ESTÁ ALGUM FICHEIRO CARREGADO NO FORMULÁRIO
		if(!empty($_FILES["image"]["tmp_name"])){
			//ESTÁ FICHEIRO CARREGADO NO FORMULÁRIO
			
			
			// Check if image file is a actual image or fake image
		  $check = getimagesize($_FILES["image"]["tmp_name"]);
		  if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		  } else {
			  //VERIFICA SE FICHEIRO É IMAGEM
			$_SESSION['imageError'] = "* File is not an image.";
			$uploadOk = 0;//INDICA INSUCESSO
		  }
		  
			// Check if file already exists
			if (file_exists($target_file)) {
			//VERIFICA SE FICHEIRO JÁ EXISTE
			  $_SESSION['imageError'] = "* Sorry, file already exists.";
			  echo "* Sorry, file already exists.";
			  $uploadOk = 0;//INDICA INSUCESSO
			}


			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			  $_SESSION['imageError'] = "* Sorry, only JPG, JPEG, PNG files are allowed.";
			  $uploadOk = 0;//INDICA INSUCESSO
			}
		}else{
			$_SESSION['imageError'] = "* File inexistent.";
			$uploadOk = 0;//INDICA INSUCESSO
		
		

		}
		
		//VERIFICA VALIDADE DOS RESTANTES DADOS (QUE NÃO A IMAGEM) DO FORMULÁRIO
		if(empty($name) || empty($price) || empty($category) || empty($brand) || empty($ean) || empty($quantity) || empty($color) || empty($gender)){
			$dadosValidos=false;
		}else{
			$dadosValidos=true;
		}
		
		if(!$dadosValidos){
			//SE DADOS FOREM INVÁLIDOS:
			
			//MENSAGENS DE ERRO
			if(empty($name)){
				$_SESSION['nameError']="* required field";
			}
			if(empty($price)){
				$_SESSION['priceError']="* required field";
			}
			if(empty($category)){
				$_SESSION['categoryError']="* required field";
			}
			if(empty($brand)){
				$_SESSION['brandError']="* required field";
			}
			if(empty($ean)){
				$_SESSION['eanError']="* required field";
			}
			if(empty($quantity)){
				$_SESSION['quantityError']="* required field";
			}
			if(empty($color)){
				$_SESSION['colorError']="* required field";
			}
			if(empty($gender)){
				$_SESSION['genderError']="* required field";
			}
			
			//REENCAMINHA PARA PÁGINA ANTERIOR E INDICA ERROS 
			header("location: ../pages/admin-new-item.php");
		}
		else{
			//DADOS SÃO VÁLIDOS:
			
			//NOME DA IMAGEM SERÁ IGUAL A EAN, PARA FACILITAR A SUA BUSCA
			$image=$ean;
			
			//NOVO NOME DO FICHEIRO
			$target_file=$target_dir.$ean.".".$imageFileType;
			
			
			
			//FAZ UPLOAD IMAGEM
			
			// VERIFICA SE HOUVE ALGUM ERRO NOS PREREQUISITOS DE CARREGAR A IMAGEM:
			if ($uploadOk == 0) {
				
			//HOUVE ERRO:
			
			//CRIA MENSAGEM ERRO
			  $_SESSION['imgError']="ERROR";
			  
			  
			} else {
				
				//NÃO HOUVE ERRO:
				
				//FAZ UPLOAD
			  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
			  } else {
				echo "Sorry, there was an error uploading your file.";
			  }
			}
			
			
			
			//ADICIONA NOVO PRODUTO A BASE DE DADOS
			
			add_product($conn, $name, $ean, $quantity, $category, $brand, $color, $price, $image, $gender);
			
			//MENSAGEM DE SUCESSO
			$_SESSION['successAddItem'] = "Item was added successfully!";
			
			//REENCAMINHA PARA PÁGINA ANTERIOR COM MENSAGEM DE SUCESSO.
			header("location: ../pages/admin-new-item.php");
		}
	}

?>