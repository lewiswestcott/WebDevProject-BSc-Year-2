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
require("./_connect.php");
$SQL = "DELETE FROM `courseLink` WHERE `courseLink`.`courseID` = " . $courseID . " AND `courseLink`.`userID` = " . $uid . ";";

mysqli_query($connect, $SQL);

echo "You have been unenrolled from this course.";