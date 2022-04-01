<?php

session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: ../login.php");
}

include_once("./_connect.php");

$CourseID = $_POST['txtCourseID'];
$Course = $_POST["txtCourse"];
$Location = $_POST["txtLocation"];
$Desc = $_POST["txtDesc"];
$MaxAttend = $_POST["txtAttend"];
$Expire = $_POST["txtExpire"];

//prepare statement

$SQL = "UPDATE `course` SET `courseName` = ?, `courseLocation` = ?, `CourseDesc` = ?, `MaxAttend` = ?, `CourseExpiry` = ? WHERE `courseID` = ?";

$stmt = mysqli_prepare($connect, $SQL);

$stmt->bind_param("ssssss", $Course, $Location, $Desc, $MaxAttend, $Expire, $CourseID);

if ($stmt->execute()) {
    //die("Course updated successfully");
    header("Location:../courseadmin.php");
} else {
    $mysqli->rollback();
    echo "Error: " . $SQL . "<br>" . mysqli_error($connect);
}
$stmt->close();
?>