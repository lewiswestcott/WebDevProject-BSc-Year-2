<?php

    session_start();

?>

<!DOCTYPE>
<html>

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
                            <a class="nav-link active lead text-light sh" aria-current="page"
                                href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lead text-light" aria-current="page" href="./user.php">User
                                Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active lead text-light" aria-current="page"
                                href="./courseadmin.php">Course
                                Management</a>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <div class="nav-item">
                            <p class="nav-link lead text-light mb-0 ">Hi!, <?= $_SESSION['firstName']?>
                                <?= $_SESSION['lastName']?></p>
                        </div>
                        <div class="nav-item">
                            <a class="nav-link lead" href="./php/logout.php">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container card text-dark bg-secondary  mb-3">
            <table class="table" id="users">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Course Location</th>
                        <th scope="col">Course Description</th>
                        <th scope="col">Maximum Attendance</th>
                        <th scope="col">Course Added</th>
                        <th scope="col">Options</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $SQL = "SELECT *, (SELECT IF (`courseLink`.`courseID` = `course`.`courseID` AND `courseLink`.`userID` = 1, 'true', 'false') FROM `courseLink` LIMIT 1) AS `isEnrolled` FROM `course`;";
                    require("./php/_connect.php");
                    $query = mysqli_query($connect, $SQL);
                    while ($course = mysqli_fetch_assoc($query))
                    {
                ?>
                    <tr>
                        <th scope="row"><?= $course['courseID'] ?></th>
                        <td><?= $course['courseName'] ?></td>
                        <td><?= $course['courseLocation'] ?></td>
                        <td><?= $course['CourseDesc'] ?></td>
                        <td><?= $course['MaxAttend'] ?></td>
                        <td><?= $course['TIMESTAMP'] ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                <button type="button" class="btn btn-danger btnDelete"><i class="fa-solid fa-ban"></i> Delete</button>
                            </div>

                        </td>

                        </td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table>
            <button class="btn btn mb-2" id="btnOpenModal">Add Course</button>

        </div>

        <div class="modal" tabindex="-1" id="modalTwo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create a new Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="./php/addcourse.php" id="createForm">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Course Name</label>
                                <input type="text" class="form-control" name="txtCourse">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Location</label>
                                <input type="text" class="form-control" name="txtLocation">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Description</label>
                                <input type="text" class="form-control" name="txtDesc">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Maximum Attendance</label>
                                <input type="number" class="form-control" name="txtAttend">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course End Date</label>
                                <input type="date" class="form-control" name="txtExpire">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
            integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
        </script>

        <script>
            $('#btnOpenModal').click(function () {
                $('#modalTwo').modal('show');
            });


            $('.btnEnrol').click(function () {
                const courseID = $(this).attr('courseID');

                $.ajax({
                    url: './php/enrol.php',
                    type: 'POST',
                    data: {
                        courseID: courseID
                    },
                    success: function (response) {
                        alert(response);
                    }
                });
            });

            $('.btnDelete').click(function () {
                const courseID = $(this).parent().attr('courseID');

                $.ajax({
                    url: './php/deletecourse.php',
                    type: 'POST',
                    data: {
                        courseID: courseID
                    },
                    success: function (response) {
                        console.log(response);
                        location.reload();

                    }
                });
            });

        </script>
    </body>

</html>