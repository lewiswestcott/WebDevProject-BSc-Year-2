<?php

    $host = "plesk.remote.ac";
    $database = "WS233812_WAD";
    $username = "WS233812_WAD";
    $password = "ConnorMcdowell!";

    $connect = mysqli_connect($host, $username, $password, $database);

    if (!$connect)
    {
        echo "Unable to connect to the database.";
    }

?>