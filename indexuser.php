<?php

session_start();

if (!isset($_SESSION['userID']))
{
    header("Location: ./login.php");
}

//Only 'admins' should be able to access this page.


?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard</title>
<!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./bootstrap.min.css">

</head>

<div class="container py-1">


<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container border-bottom">
            <a class="navbar-brand" href="#"><img class="" src="./img/logo.svg" width="150" height="60"></img></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a class="nav-link active lead text-light sh" aria-current="page" href="./index.php">Home</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active lead text-light" aria-current="page" href="./courseuser.php">Courses</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="nav-item">
                        <p class="nav-link lead text-light mb-0 ">Hi, <?= $_SESSION['firstName']?>
                            <?= $_SESSION['lastName']?></p>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link lead" href="./php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>




    <div class="pricing-header p-2 pb-md-2 mx-auto text-center">
        <h1 class="display-4 fw-normal">Welcome, <?= $_SESSION['firstName']?> to CourseLink!</h1>
        <p class="fs-5 text-muted">Welcome to CourseLink! Here you will be able to view available courses by clicking Courses in the navigation bar. Below you will see the courses you have been enrolled into as well as a tutorial of how to use this site.
        </p>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card text-dark bg-secondary mb-2">
                    <div class="card-header">Tutorial</div>
                    <div class="card-body">
                        <h4 class="card-title">Video Here</h4>

                    </div>
                </div>

                <div class="col-12">
                <div class="card text-dark bg-primary mb-2">
                    <div class="card-header">Your Courses</div>
                    <div class="card-body">

                    </div>
                </div>
        </div>
        </div>






</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
</script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#users').DataTable();
});

$('#btnOpenModal').click(function () {
    $('#modalOne').modal('show');
});

$('.btnDelete').click(function () {
    const userID = $(this).parent().attr('userid');

    $.ajax({
        url: './php/deleteUser.php',
        type: 'POST',
        data: {
            userID: userID
        },
        success: function (response) {
            console.log(response);
            location.reload();

        }
    });
});
</script>
</body>

</div>

</html>