<?php

    // Enable us to use Headers
    ob_start();

    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }
    $dbname = "bae";

    // REMOTE ONLINE DATABASE
    $hostname = "ssd.ennio.co.uk";
    $username = "ssd-cwk1-bae";
    $password = "luwandagga";

    // LOCAL DATABASE - UNCOMMENT TO CONNECT TO IT
    //$hostname = "localhost";
    //$username = "root";
    //$password = "";
  

    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")

?>
