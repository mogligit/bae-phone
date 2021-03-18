<?php

	/*-- included connection files--*/
	include "../config/db.php";

	/*---  create variables to display the error message on design page ------*/
	$error = "";

	if (isset($_POST["btn_upload"]) == "Upload")
	{
		$file_tmp = $_FILES["fileImg"]["tmp_name"];
		$file_name = $_FILES["fileImg"]["name"];

		/*image name and description that will insert in database ---*/
		$image_name = $_POST["img-name"];
		$image_description = $_POST["description"];
		$image_price = $_POST["price"];

		//image file type
		$imageFileType = strtolower(pathinfo($file_name,PATHINFO_EXTENSION));

		//image directory where actual image will be stored
		$img_path = "/ssd-cwk1-bae/media/$image_name";

	/*---------------- php textbox validation checking ------------------*/
	if($image_name == "")
	{
		$error = "Please enter Image name.";
	}
	elseif($image_description == "")
	{
		$error = "Please include a description";
	}
	elseif ($image_price == "") {
		$error = "Please inlude a price";
	}

	//word limitation
	elseif(strlen($image_name) < 1 || strlen($image_name) > 50)
	{
	if (strlen($image_name) >50)
	{
	$error = "Make/	Model length too long";
	}
	}

	elseif(strlen($image_description) < 1 || strlen($image_description) > 500)
	{
	if (strlen($image_description) >500)
	{
		$error = "Description too long, please write less than 500 words";
	}
	}

	//Ensure no special characters are used
	elseif(!preg_match("/^[\r\na-zA-Z0-9,-.():£&'\s]*$/", $image_name))
	{
		$error = "Only letters and numbers allowed(No special characters)";
	}
	elseif(!preg_match("/^[\r\na-zA-Z0-9,-.():£&'\s]*$/", $image_description))
	{
		$error = "Only letters and numbers allowed(No special characters).";
	}
	elseif(!preg_match("/^[0-9]*$/", $image_price))
	{
		$error = "Only numbers allowed on price.";
	}

	/*-------- insertion of image  -------------*/
	else
	{
		if ($file_name == "")  {
				$error = "Please select an image";
		}
		elseif(file_exists($img_path))
		{
			$error = "Sorry,The <b>".$file_name."</b> image already exists.";
		}

// Check file size
	elseif ($_FILES["fileImg"]["size"] > 500000)
	{
  	$error = "Sorry, your file is too large.";
	}

		else
			{
				// prepared statement to prevent SQL injection
				if ($stmt = $connection->prepare("INSERT INTO `phone_ad`(`title`,`seller_id`,`img_path`,`description`,`price`) 
				VALUES(?,?,?,?,?);")) 
				{
					$stmt->bind_param("sissi", $image_name, $_SESSION['id'], $img_path, $image_description, $image_price);
					$stmt->execute();
					$stmt->close();
					move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT'] . $img_path);
					header( "Location: /ssd-cwk1-bae/redirection.php" );
				} else {
					die("image not inserted". mysqli_error($connection));
				}
				exit ;
			}
		}
	}
?>
