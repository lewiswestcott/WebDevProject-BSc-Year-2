<?php

    session_start();


    if($_SESSION['role'] == "User")
    {
        header("Location: ./courseuser.php");
    }

                       




?>

<!DOCTYPE HTML>
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

    <link rel="stylesheet" href="./courseadmin.css">

    <style>
        .card-container {
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: repeat(1, 1fr);
            gap: 20px;
            grid-auto-flow: row;
            grid-template-areas:
                ". . .";
        }

        @media screen and (max-width: 600px) {
            .card-container {
                grid-template-columns: 1fr;
                grid-template-rows: repeat(2, 1fr);
                grid-template-areas:
                    "."
                    ".";
            }
        }
    </style>

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

            <?php
                    $SQL = "SELECT *, (SELECT IF (`courseLink`.`courseID` = `course`.`courseID` AND `courseLink`.`userID` = 1, 'true', 'false') FROM `courseLink` LIMIT 1) AS `isEnrolled` FROM `course`;";
                    require("./php/_connect.php");
                    $query = mysqli_query($connect, $SQL);
                    while ($course = mysqli_fetch_assoc($query))
                    {
                ?>

            <?php
                    }
                ?>


            <div class="card-container">
                <?php
                require("./php/_connect.php");
                $query = mysqli_query($connect, $SQL);
                while ($course = mysqli_fetch_assoc($query))
                {
            ?>
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        Course #LW<?= $course['courseID'] ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-graduation-cap"></i> <?= $course['courseName'] ?> -
                            <?= $course['courseLocation'] ?></li>
                        </h5>
                        <p class="card-text"><?= $course['CourseDesc'] ?></p>
                    </div>


                    <ul class="list-group list-group-flush">

                        <?php
                        $courseID = $course['courseID'];
                        $selectfromcourse = mysqli_query($connect, "SELECT * FROM courseLink WHERE courseID = $courseID");
                        $attendees = mysqli_num_rows($selectfromcourse);
                        ?>

                        <li class="list-group-item"><?= $attendees ?> out of <?= $course['MaxAttend'] ?> enrollments
                        </li>
                        <li class="list-group-item">Course Added: <?= $course['TIMESTAMP'] ?></li>
                        <li class="list-group-item">Course Expiration: <?= $course['CourseExpiry'] ?></</li> </ul> <div
                                class="card-body">
                            <div class="btn-group" role="group" aria-label="Basic example"
                                courseID="<?= $course['courseID'] ?>">
                                <button type="button" id="btnView" class="btn btn-warning btnView btn-sm"><i class="fa-solid fa-magnifying-glass"></i>
                                    View</button>
                                <button type="button" id="btnEditModal" class="btn btn-warning btnEditModal btn-sm"><i class="fa-solid fa-pen-to-square"></i>
                                    Edit</button>
                                <button type="button"  class="btn btn-danger btnDeleteCourse btn-sm"> <i
                                        class="fa-solid fa-ban"></i> Delete</button>
                            </div>
                </div>



            </div>

            <?php
                }
            ?>

        </div>

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
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" class="form-control" name="txtDuration" id="txtDuration">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="modalThree">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit a Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="./php/updatecourse.php" id="createForm">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="txtCourse" id="txtCourse">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Location</label>
                        <input type="text" class="form-control" name="txtLocation" id="txtLocation">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Description</label>
                        <input type="text" class="form-control" name="txtDesc" id="txtDesc"> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Maximum Attendance</label>
                        <input type="number" class="form-control" name="txtAttend" id="txtAttend">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course End Date</label>
                        <input type="date" class="form-control" name="txtExpire" id="txtExpire">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration</label>
                        <input type="text" class="form-control" name="txtDuration" id="txtDuration">
                    </div>
                </div>
                <div class="modal-footer">
                <input type="hidden" name="txtCourseID" id="txtCourseID">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" id="CourseCreated">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
                Users Enrolled
        </div>
        <div class="modal-body">
        <table class="table" id="users">
                <thead>
                    <tr>
                        <th scope="col">Course ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Role</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody id="viewUsersData">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</div>


<footer>
    <div class="container py-1">
        <div class="col-12">
            <div class="container border-top mb-2">

                <div class="">
                    <p class="lead mt-2 text-center">&copy; <img src="./img/logo.svg" class="mb-1" height="17px">
                        <?php echo date ('Y'); ?></p>

                </div>
            </div>
        </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
    integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        $('#users').DataTable();
    });

    $('#btnOpenModal').click(function () {
        $('#modalTwo').modal('show');
    });

    $('.btnEditModal').click(function () {
        $('#modalThree').modal('show');
        $.ajax({
            method: "post",
            url: './php/fetchcourse.php',
            data: {
                courseID : $(this).parent().attr("courseID")
            },
            success: function(result) {
                console.log(result);
                var course = JSON.parse(result);
                console.log(course);

                $("#txtCourse").val(course.courseName);
                $("#txtLocation").val(course.courseLocation);
                $("#txtCourseID").val(course.courseID);
                $("#txtDesc").val(course.CourseDesc);
                $("#txtAttend").val(course.MaxAttend);
                $("#txtExpire").val(course.CourseExpiry);
                $("#editUserModal").modal('toggle');


            }          
        });
    });


    $("#createForm").submit(function (event) {
        //This prevents the default synchronous action.
        event.preventDefault();

        $.ajax({
            //Populates the AJAX request.
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
                location.reload();
            },
            error: function () {
                //This function will run if the request failed.
                alert("Something went wrong with the AJAX call.");
            }
        });
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

    $('.btnDeleteCourse').click(function () {
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

    $('#sendMessage').submit(function(e) {
        e.preventDefault();

        const msg = $('#msg').val();

        $.ajax({
            url: 'send.php',
            type: 'POST',
            data: {
                msg: msg
            },
            success: function(data) {
                console.log(data);
            }
        });

    });

    $('.btnView').click(function () {
            const courseID = $(this).parent().attr('courseID');
            $.ajax({
                url: './php/showusers.php',
                type: 'POST',
                data: {
                    courseID: courseID
                },
                success: function (response) {
                    $('#viewUsersData').html(response);
                    $('#exampleModal').modal('show');
                }
            });
        });
</script>
</body>

</html>