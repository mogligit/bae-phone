<?php
include('config/db.php'); 

if (isset($_POST['btnLogout'])) {
    session_unset();
    header("Location: index.php");
}

if (isset($_POST['btnDeleteAd'])) {
    if ($stmt = $connection -> prepare("DELETE FROM `phone_ad` WHERE `id` = ? AND `seller_id` = ?;"))
    {
        $stmt->bind_param("ii", $_POST['btnDeleteAd'], $_SESSION['id']);
        $stmt -> execute();
        $stmt -> close();
    }
}
?>?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Dashboard</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <style>
    .App {
        width: unset;
        height: unset;
        padding-top: 40px;
        padding-bottom: 20px;
    }
    </style>

</head>

<body>
    <?php include("header.php") ?>
    <div class="App">
    <div class="container mt-5">
        <div class="d-flex justify-content-center">
            <div class="card" style="width: 25rem">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Logged In User Profile</h5>
                    <h6 class="card-subtitle mb-2 text-muted"><?php echo $_SESSION['firstname']; ?>
                        <?php echo $_SESSION['lastname']; ?></h6>
                    <p class="card-text">Email address: <?php echo $_SESSION['email']; ?></p>
                    <p class="card-text">Mobile number: <?php echo $_SESSION['mobilenumber']; ?></p>

                    <form method="post" action="/ssd-cwk1-bae/dashboard.php">
                        <input type="submit" name="btnLogout" value="Log out" class="btn btn-danger btn-block" href="index.php">
                    </form>
                    <br>



                    <h5 class="card-title text-center mb-4">Your ads</h5>
                    <table class="table">
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    <?php
                    if ($stmt = $connection -> prepare("SELECT `id`, `title`, `price` FROM `phone_ad` WHERE `phone_ad`.`seller_id` = ? ORDER BY `date_posted` DESC;"))
                    {
                        $stmt->bind_param("i", $_SESSION['id']);
                        $stmt -> execute();
                        $stmt -> bind_result($adId, $adTitle, $adPrice);
                        $stmt -> store_result();

                        while ($stmt -> fetch())
                        {
                            echo "
                            <tr>
                                <td><a class=\"btn btn-link\" href=\"phonead.php?id=$adId\">$adTitle</a></td>
                                <td>£$adPrice</td>
                                <td>
                                    <form method=\"post\" action=\"/ssd-cwk1-bae/dashboard.php\">
                                        <input type=\"hidden\" name=\"btnDeleteAd\" value=$adId>
                                        <input type=\"submit\" value=\"Delete ad\" class=\"btn btn-link\">
                                    </form>
                                </td>
                            </tr>
                            ";
                        }

                        $stmt -> free_result();
                        $stmt -> close();
                    }
                    ?>                        
                    </table>

                </div>
            </div>
        </div>
    </div>
  </div>

</body>

</html>
