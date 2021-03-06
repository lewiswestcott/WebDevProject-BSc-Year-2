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

$SQL = "INSERT INTO `course`(`courseID`, `courseName`, `courseLocation`, `CourseDesc`, `CourseExpiry`, `MaxAttend`, `TIMESTAMP`) VALUES ('NULL',?,?,?,?,?,current_timestamp())";

//Prepares the SQL statement for execution.
$stmt = mysqli_prepare($connect, $SQL);

mysqli_stmt_bind_param($stmt, 'sssss', $_POST['txtCourse'], $_POST['txtLocation'], $_POST['txtDesc'], $_POST['txtAttend'],  $_POST['txtExpire']);

//Executes the prepared query.
if (mysqli_stmt_execute($stmt))
{
    echo "Course Created";
}
else
{
    echo "Error: " . mysqli_error($connect);
}

//Closes the prepared statement.
mysqli_stmt_close($stmt);