<?php
session_start();
//Check if the user is logged in
if (!isset($_SESSION['userID']))
{
    header("Location: ./login.php");
    die();
}
//Check if the user has provided a valid holidayID
if (!isset($_POST['courseID']))
    die("No courseID was provided.");
//Connect to the database
require("_connect.php");

$courseID = $_POST['courseID'];
$uid = $_SESSION["userID"];

//check holiday isnt full code here//code here count mysql


$SQL = "INSERT INTO `courseLink`(`linkID`, `courseID`, `userID`, `TIMESTAMP`) VALUES (NULL, '$courseID', '$uid', current_timestamp())
";

if (mysqli_query($connect, $SQL))
    echo "You have been enrolled on the course!";
else
    echo "An error has occoured.";