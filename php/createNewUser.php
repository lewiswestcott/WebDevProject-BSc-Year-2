<?php

session_start();

if (!isset($_SESSION['userID']))
{
    header("Location: ./login.php");
}

if (!isset($_POST))
{
    die("Missing POST Values");
}

require("_connect.php");

//The SQL statement
$password = $_POST["txtPassword"];
$password = password_hash($password, PASSWORD_BCRYPT);

$SQL = "INSERT INTO `users` (`userID`, `email`, `firstName`, `lastName`, `password`, `TIMESTAMP`) VALUES (NULL, ?, ?, ?, ?, current_timestamp())";

//Prepares the SQL statement for execution.
$stmt = mysqli_prepare($connect, $SQL);

mysqli_stmt_bind_param($stmt, 'ssss', $_POST['txtEmail'], $_POST['txtFirst'], $_POST['txtLast'], $_POST['txtPassword']);

//Executes the prepared query.
if (mysqli_stmt_execute($stmt))
{
    echo "User Created";
}
else
{
    echo "Error: " . mysqli_error($connect);
}

//Closes the prepared statement.
mysqli_stmt_close($stmt);