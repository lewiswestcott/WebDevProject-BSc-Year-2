<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./bootstrap.min.css">


    <link rel="stylesheet" href="loginvideo.css">

</head>

<body class="bg-dark vh-100">
    <div class="container-fluid d-flex h-100 justify-content-center align-items-center">
        <section class="login bg-secondary p-5 shadow-lg rounded">
            <h1 class="text-center mb-5">Login Page</h1>

            <form id="login-form" class="ms-4 me-4">
                <div class="mb-3">
                    <label for="txtEmail" class="form-label">Email Address</label>
                    <input type="text" class="form-control" name="txtEmail" required>
                </div>

                <div class="mb-3">
                    <label for="txtPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" name="txtPassword" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </section>
    </div>

    <video autoplay muted loop id="myVideo">
    <source src="./img/pexels2.mp4" type="video/mp4">
    </video>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js"
        integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous">
    </script>

    <script src="https://www.google.com/recaptcha/api.js?render=6LdT5bIeAAAAAE-I0BW3zPVDJI-dm72y-xry9Grc"></script>

    <script>
        function Login() {
            grecaptcha.ready(function () {
                grecaptcha.execute('6LdT5bIeAAAAAE-I0BW3zPVDJI-dm72y-xry9Grc', {
                    action: 'create_comment'
                }).then(function (token) {
                    $.ajax({
                        //Populates the AJAX request.
                        url: './php/auth.php',
                        type: 'POST',
                        data: $('#login-form').serialize() + "&token=" + token,
                        success: function (response) {
                            //This function will run if the request was successful.

                            //If the server replies with 'true', redirect them to another page.
                            if (response == "true") {
                                window.location.href = "index.php";
                            } else {
                                //Otherwise, display an error message.
                                alert("Error: " + response);
                            }
                        },
                        error: function () {
                            //This function will run if the request failed.
                            alert("Something went wrong with the AJAX call.");
                        }
                    });
                });
            });
        }




            //This event will execute when a subsequent
            //form with the correct ID is submitted.

            $("#login-form").submit(function (event) {

                //This prevents the default synchronous action.
                event.preventDefault();

                Login();

            });

    </script>
</body>

</html>