<?php

session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php");
}

include_once("./_connect.php");

$userID = $_POST["txtUserID"];
$email = $_POST["txtEmail"];
$firstName = $_POST["txtFirst"];
$lastName = $_POST["txtLast"];
$jobTitle = $_POST["txtJob"];
$accessLevel = $_POST["txtRole"];

//prepare statement
$SQL="UPDATE `users` SET `email`=?,`firstName`=?,`lastName`=?,`JobRole`=?,`role`= ? WHERE `userID`=?";
$stmt = mysqli_prepare($connect, $SQL);
$stmt->bind_param("ssssss", $email, $firstName, $lastName, $jobTitle, $accessLevel, $userID);
if ($stmt->execute()) {
    echo json_encode(array("statusCode" => 200));
}
else {
    $mysqli->rollback();
    echo json_encode(array("statusCode" => 201));
}
$stmt->close();
?>