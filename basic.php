<?php

    session_start();

    if (!isset($_SESSION['userID']))
    {
        header("Location: ./login.php");
    }

    $rawData = file_get_contents("https://api.covid19api.com/summary");

    $json = json_decode($rawData);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Basic</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="basic.php">API Basic</a>
                    </li>
                </ul>
                
                <div class="d-flex">
                    <div class="nav-item">
                        <a class="nav-link" href="./php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container bg-light mt-5 shadow-lg">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Country Name 🌍</th>
                    <th scope="col">Cases 😷</th>
                    <th scope="col">Deaths 💀</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    
                    foreach ($json->Countries as $country)
                    {
                        echo "<tr>";
                        echo "<td>".$country->Country."</td>";
                        echo "<td>". number_format($country->TotalConfirmed) ."</td>";
                        echo "<td>". number_format($country->TotalDeaths) ."</td>";
                        echo "</tr>";
                    }

                ?>

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
</body>

</html>