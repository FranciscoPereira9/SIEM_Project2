<?php
	session_start();
	include '../database/db_functions.php';
	include '../includes/opendb.php';
	
	
	if(!empty($_POST['additem'])){
		$name=$_POST['product-name'];
		$price=$_POST['product-price'];
		$category=$_POST['product-category'];
		$brand=$_POST['product-brand'];
		$ean=$_POST['product-ean'];
		$quantity=$_POST['product-quantity'];
		$color=$_POST['color'];
		$gender=$_POST['gender'];
		
		
		//VALIDAR IMAGEM
		
		$target_dir = "../images/products/$gender/$category/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(!empty($_FILES["image"]["tmp_name"])){
			
		  $check = getimagesize($_FILES["image"]["tmp_name"]);
		  if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		  } else {
			$_SESSION['imageError'] = "* File is not an image.";
			$uploadOk = 0;
		  }
		  
			// Check if file already exists
			if (file_exists($target_file)) {
			  $_SESSION['imageError'] = "* Sorry, file already exists.";
			  echo "* Sorry, file already exists.";
			  $uploadOk = 0;
			}


			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
			  $_SESSION['imageError'] = "* Sorry, only JPG, JPEG, PNG files are allowed.";
			  echo "2";
			  $uploadOk = 0;
			}
		}else{
			$_SESSION['imageError'] = "* File inexistent.";
			$uploadOk = 0;
		
		

		}
		
		
		if(empty($name) || empty($price) || empty($category) || empty($brand) || empty($ean) || empty($quantity) || empty($color) || empty($gender)){
			$dadosValidos=false;
			echo "3";
		}else{
			$dadosValidos=true;
		}
		
		if(!$dadosValidos){
			echo "4";
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
			header("location: ../pages/admin-new-item.php");
		}
		else{
			$image=$ean;
			
			$target_file=$target_dir.$ean.".".$imageFileType;
			//FAZ UPLOAD IMAGEM
			
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  $_SESSION['genderError']="* required field";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
				echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
			  } else {
				echo "Sorry, there was an error uploading your file.";
			  }
			}
			
			//ADICIONA BASE DE DADOS
			
			add_product($conn, $name, $ean, $quantity, $category, $brand, $color, $price, $image, $gender);
			$_SESSION['successAddItem'] = "Item was added successfully!";
			
			
			header("location: ../pages/admin-new-item.php");
		}
	}

?>