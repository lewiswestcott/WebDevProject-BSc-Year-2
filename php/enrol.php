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
$SQL = "SELECT *, (SELECT IF (`courseLink`.`courseID` = `course`.`courseID` AND `courseLink`.`userID` = 1, 'true', 'false') FROM `courseLink` LIMIT 1) AS `isEnrolled` FROM `course`;";
$query = mysqli_query($connect, $SQL);
while ($course = mysqli_fetch_assoc($query))
$courseID = $course['courseID'];
$selectfromcourse = mysqli_query($connect, "SELECT * FROM courseLink WHERE courseID = $courseID");
$attendees = mysqli_num_rows($selectfromcourse);

if ($attendees <= 0)
    {
       echo "The course is full, please enrol on a different course";
       die();
    }

$SQL = "INSERT INTO `courseLink`(`linkID`, `courseID`, `userID`, `TIMESTAMP`) VALUES (NULL, '$courseID', '$uid', current_timestamp())
";

if (mysqli_query($connect, $SQL))
    echo "You have been enrolled on the course!";
else
    echo "An error has occoured.";