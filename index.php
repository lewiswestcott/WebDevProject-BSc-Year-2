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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="basic.php">API Basic</a>
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

    <div class="container mt-4 p-5 shadow-lg rounded bg-success ">
        <table class="table" id="users">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
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
                    <td>
                        <div class="btn-group" role="group" userid="<?= £user['userID'] ?>">
                            <button type="button" class="btn btn-primary btn-sm"><i
                                    class="fa-solid fa-hotdog"></i></button>
                            <button type="button" class="btn btn-warning btn-sm"><i
                                    class="fa-solid fa-horse"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i
                                    class="fa-solid fa-closed-captioning"></i></button>
                        </div>
                    </td>
                </tr>

                <?php
                    }

                ?>

            </tbody>
        </table>

        <button class="btn btn-danger" id="btnOpenModal">Open the Modal</button>
    </div>

    <div class="modal" tabindex="-1" id="modalOne">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a new User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="./php/createNewUser.php">
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
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="txtPassword">
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

</html>