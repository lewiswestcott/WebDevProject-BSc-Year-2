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
$SQL = "SELECT *, (SELECT IF (`courseLink`.`courseID` = `course`.`courseID` AND `courseLink`.`userID` = '$uid', 'true', 'false') FROM `courseLink` LIMIT 1) AS `isEnrolled` FROM `course` WHERE `courseID` = " . $courseID . ";";

$isAlreadyEnrolled = mysqli_fetch_assoc(mysqli_query($connect, $SQL));

var_dump($isAlreadyEnrolled);

if ($isAlreadyEnrolled['isEnrolled'] == 1)
{
    die("Sorry, you are already enrolled on this course.");
}

// while ($course = mysqli_fetch_assoc($query))
$selectfromcourse = mysqli_query($connect, "SELECT * FROM courseLink WHERE courseID = $courseID");
$attendees = mysqli_num_rows($selectfromcourse);

if ($attendees >= $isAlreadyEnrolled['MaxAttend'])
{
    die("The course is full, please enrol on a different course");
}

$SQL = "INSERT INTO `courseLink` (`linkID`, `courseID`, `userID`, `TIMESTAMP`) VALUES (NULL, '$courseID', '$uid', current_timestamp())";

/* $email = "SELECT * FROM `course` WHERE `courseID` = $courseID"; */
// die($SQL);

if (mysqli_query($connect, $SQL))
{
    echo "You have been enrolled on the course!";
    /* $address = $_SESSION['email'];
    $subject = "You have been enrolled on " .  $email['courseName'];

    $emailContent = "You have been enrolled on " . $email['courseName'];

    $headers = "From: noreply@courselink.com" . "\r\n";

    mail($address, $subject, $emailContent, $headers); */
}
else
    echo "An error has occoured.";