<?php
$adId = $_POST['adId'];

include "config/db.php";

/* query to get all information about the ad with id=$adId including the user who posted it
    $adId is wrapped again in htmlspecialchars() to prevent XSS */
if ($stmt = $connection->prepare("UPDATE `phone_ad` SET `is_sold` = true WHERE `id` = ? ")) {
    $stmt->bind_param("i", $adId);
    $stmt->execute();
    $stmt->close();
}
?>

<!doctype html>
<html>

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
    <div class="container main">
        <div class="App">
            <div class="vertical-center">
                <div class="inner-block">
                    <div class="content">
                        <h6>
                            <?php 
                                if (null != mysqli_error($connection)) {
                                    echo "Ad could not be sold. Please try again.";
                                } else {
                                    echo "SOLD!<br>Your new phone is on the way :)";
                                }
                            ?>
                        </h6>

                        <a href="index.php" class="btn btn-primary">Go back</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>