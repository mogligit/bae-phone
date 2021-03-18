<?php 
include('config/db.php');
// if the search parameter is there and if it's not empty
if (isset($_GET['search']) && strlen($_GET['search']) != 0) {
    // then assign it to variable
    $searchTerm = htmlspecialchars($_GET['search']);    // prevents XSS
} else {
    // otherwise set to wildcard
    $searchTerm = '%';  // SQL wildcard
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <title>BAE Phones - Home</title>
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
    <?php
        include('header.php');
    ?>
<div class="container main">
    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <div class="content">
                    <!-- small form for search bar - it does a Get request to itself with the search term -->
                    <form class="input-group search-bar" action="index.php" method="get">
                        <input type="text" name="search" class="form-control" placeholder="Seach brand, model... eg. Samsung Galaxy S8" 
                        value="<?php
                            if ($searchTerm != '%') {
                                echo $searchTerm;
                            }
                        ?>">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="submit">Go</button>
                        </div>
                    </div>

                    <?php
                        if ($searchTerm == '%') {
                            echo "<h2>All ads</h2>";
                        } else {
                            echo "<h2>Searching \"" . $searchTerm . "\"</h2>";
                        }
                    ?>
                    
                    <div class="tile-grid">
                        <?php
                            /*
                            sql query gets ads in reverse chronological order
                            the search term is already in the query but if it contains '%' it matches everything
                            once the search bar contains text the query will filter the results
                            */
                            if ($stmt = $connection -> prepare("SELECT `id`, `title`, `img_path`, `price` FROM `phone_ad` WHERE `phone_ad`.`is_sold` = false AND (`title` LIKE ? OR `phone_ad`.`description` LIKE ?) ORDER BY `date_posted` DESC;"))
                            {
                                $sqlTerm = "%{$searchTerm}%";    // preparing search term for sql query
                                $stmt->bind_param("ss", $sqlTerm, $sqlTerm);
                                $stmt -> execute();
                                $stmt -> bind_result($adId, $adTitle, $imgPath, $adPrice);
                                $stmt -> store_result();

                                while ($stmt -> fetch())
                                {
                                    // all variables are wrapped with htmlspecialchars() to ensure two way validation. just because it comes from the database doesnt mean its secure
                                    echo "
                                    <a class=\"phonead-tile\" href=\"phonead.php?id=" . htmlspecialchars($adId) . "\">
                                        <img src=\"" . htmlspecialchars($imgPath) . "\" alt=\"" . htmlspecialchars($adTitle) . "\">
                                        <div class=\"phonead-tile-description\">
                                            <strong>" . htmlspecialchars($adTitle) . "</strong>
                                            £" . htmlspecialchars($adPrice) . "
                                        </div>
                                    </a>
                                    ";
                                }

                                $stmt -> free_result();
                                $stmt -> close();
                            }
                        ?>
                    </div>

                </div>

            </div>
        </div>
    </div>

</body>

</html>
