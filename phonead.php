<?php
$adId = $_GET['id'];

include "config/db.php";

/* query to get all information about the ad with id=$adId including the user who posted it
$adId is wrapped again in htmlspecialchars() to prevent XSS */
if ($stmt = $connection->prepare("SELECT `phone_ad`.`id`, `title`, `img_path`, `description`, `price`, `date_posted`, `firstname`, `lastname` FROM `phone_ad`, `users` WHERE `phone_ad`.`id`= " . htmlspecialchars($adId) . " AND `phone_ad`.`seller_id` = `users`.`id`;")) {
    $stmt->execute();
    $stmt->bind_result($adId, $adTitle, $imgPath, $adDescription, $adPrice, $datePosted, $sellerFirstName, $sellerLastName);
    $stmt->store_result();
    $stmt->fetch();
    $stmt->free_result();
    $stmt->close();

    $sellerFullName = $sellerFirstName . " " . $sellerLastName;
}
echo mysqli_error($connection);

?>


<!doctype html>
<html lang="en/gb">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/phonead.css">
    <title>BAE Phones - <?php echo $adTitle; ?></title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>

    <style>
        body,
        html,
        .App,
        .vertical-center {
            width: unset;
            height: unset;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .inner-block {
            min-width: 80%;
        }
    </style>

    <!-- Header -->
    <?php include('header.php'); ?>
    <div class="container main">
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <div class="content">
                    <!-- arrange ad elements -->
                    <div class="phonead-header"">
                        <div class="title">
                            <h1><?php echo $adTitle; ?></h1>
                            <p>Seller: <strong><?php echo $sellerFullName; ?></strong></p>
                        </div>
                        <div class="buy-group">
                            <p class="price">£<?php echo $adPrice; ?></p>
                            <form action="buy.php" method="post">
                                <input type="hidden" name="adId" value="<?php echo $adId ?>">
                                <input type="submit" value="Buy now!" name="btnBuy" class="btn btn-primary">
                            </form>
                        </div>
                    </div>

                    <div class="phonead-body">
                        <img class="phonead-image" src="<?php echo $imgPath; ?>" alt="">
                        <p class="phonead-description"><?php echo $adDescription; ?></p>
                    </div>



                </div>
            </div>
        </div>

  </div>
</div>
</body>

</html>
