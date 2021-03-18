<?php include('../config/db.php'); ?>
<?php

		include('upload-code.php'); // Include upload code Script page.

		if (!isset($_SESSION['id'])) {	//if its not signed in
			header("Location: /ssd-cwk1-bae/log.php");
		}

	?>

<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<title>Image Upload</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/ssd-cwk1-bae/css/upload.css">
	<link rel="stylesheet" href="/ssd-cwk1-bae/css/style.css">

	</head>

	<body>
		<!-- Header -->
		<?php include($_SERVER['DOCUMENT_ROOT'] . "/ssd-cwk1-bae/header.php"); ?>

	<div class="container main" >
		<div class="positioning" >
		<div class="form_container">
			<h2 style="color:blue">SELL YOUR MOBILE!!</h2>
			<form method="POST" name="upfrm" action="" enctype="multipart/form-data">
				<div>

					<div class="image-desc">
							<form method="POST" name="desc" action="" enctype="multipart/form-data">
								<textarea type="text" placeholder="Enter make and model of device (e.g. Iphone 12 pro)" contenteditable="true" spellcheck="true" name="img-name" class="tb" /></textarea>

								<textarea type="text" placeholder="Please enter details about this phone (condition, colour, storage etc)."
								id="img_desc" name="description" class="desc-input"/ contenteditable="=true" spellcheck="true"></textarea>

								<textarea type="text" placeholder="Price"
								id="img_price" name="price" class="price-input"/ contenteditable="=true" ></textarea>

				</div>
				<strong>
					<label id="image-option">Choose Image to upload</label>
				</strong>
					<input type="file" name="fileImg" class="file_input" >
					<input type="submit" value="Submit" name="btn_upload" class="btn" />
				</div>
			</form>
			<div class="msg">
        <strong>
            <?php if(isset($error)){echo $error;}?>
        </strong>
			</div>
		</div>
	</div>
</div>



	<marquee class="marquee">Thank you for the support !!!!!!</marquee>
	</body>
	</html>
