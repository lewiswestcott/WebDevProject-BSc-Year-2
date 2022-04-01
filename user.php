<?php

    session_start();

    if (!isset($_SESSION['userID']))
    {
        header("Location: ./login.php");
    }

    //Only 'admins' should be able to access this page.
    if($_SESSION['role'] == "User")
    {
        header("Location: ./courseuser.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Administration</title>
    <!--  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./bootstrap.min.css">

    <style>
        * {
            color: white !important;
        }

        @media screen and (max-width: 1000px) {
            .admintable {
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

        <div class="admintable">
            <div class="container card text-dark bg-secondary  mb-3">
                <table class="table text-light" id="users">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">User Type</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                    $SQL = "SELECT * FROM `users`";

                    require("./php/_connect.php");

                    $query = mysqli_query($connect, $SQL);

                    while ($user = mysqli_fetch_assoc($query))
                    {
                ?>

                        <tr>
                            <th scope="row"><?= $user['userID'] ?></th>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['firstName'] ?></td>
                            <td><?= $user['lastName'] ?></td>
                            <td><?= $user['JobRole'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td>
                                <div class="btn-group" role="group" userid="<?= $user['userID'] ?>">

                                    <button type="button" class="btn btn-warning btn-sm btnEditModal"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tooltip on top"><i
                                            class="fa-solid fa-screwdriver-wrench "></i> Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm btnDelete"><i
                                            class="fa-solid fa-circle-minus"></i> Delete</button>
                                </div>
                            </td>
                        </tr>

                        <?php
                    }

                ?>

                    </tbody>
                </table>

                <button class="btn btn mb-2" id="btnOpenModal">Add User</button>
            </div>

            <div class="modal" tabindex="-1" id="modalOne">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Create a new User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" action="./php/createNewUser.php" id="createForm">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="txtEmail">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="txtFirst">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="txtLast">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Job Role</label>
                                    <input type="text" class="form-control" name="txtJob">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="txtPassword">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <br>
                                    <select class="text-light form-control" name="txtRole">
                                        <option value=Admin>Admin</option>
                                        <option value=User>User</option>
                                    </select>
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
        </div>

        <!--         edit user
 -->

        <div class="modal" tabindex="-1" id="modalTwo">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="./php/updateuser.php" id="UpdateForm">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="txtEmail" id="txtEmail">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" name="txtFirst" id="txtFirst">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" name="txtLast" id="txtLast">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Job Role</label>
                                <input type="text" class="form-control" name="txtJob" id="txtJob">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="txtPassword" id="txtPassword">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <br>
                                <select class="text-light form-control" name="txtRole" id="txtRole">
                                    <option value=Admin>Admin</option>
                                    <option value=User>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="txtUserID" id="txtUserID">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <footer>
            <div class="container py-1">
                <div class="col-12">
                    <div class="container border-top mb-2">

                        <div class="">
                            <p class="lead mt-2 text-center">&copy; <img src="./img/logo.svg" class="mb-1"
                                    height="17px">
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

        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#users').DataTable();
            });

            $('#btnOpenModal').click(function () {
                $('#modalOne').modal('show');
            });

            $('.btnEditModal').click(function () {
                $('#modalTwo').modal('toggle');

                $.ajax({
                    method: "post",
                    url: './php/fetchuser.php',
                    data: {
                        userID: $(this).parent().attr("userid")
                    },
                    success: function (result) {
                        console.log(result);
                        var user = JSON.parse(result);
                        $("#txtFirst").val(user.firstName);
                        $("#txtLast").val(user.firstName);
                        $("#txtUserID").val(user.userID);
                        $("#txtEmail").val(user.email);
                        $("#txtRole").val(user.role);
                        $("#txtJob").val(user.JobRole);
                        $("#editUserModal").modal('toggle');


                    }

                })

            });

            $('#UpdateForm').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    method: "post",
                    url: './php/updateuser.php',
                    data: $('#UpdateForm').serialize(),
                    success: function (result) {
                        var res = JSON.parse(result);
                        $('#editUserModal').modal('toggle');
                        location.reload();
                    }

                })
            });

            $("#UpdateForm").submit(function (event) {
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