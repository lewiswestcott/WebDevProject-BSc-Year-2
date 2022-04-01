<?php

session_start();


$userID = $_SESSION['userID'];
$courseID = $_POST['courseID'];

//sql
$sequl = "SELECT DISTINCT `users`.*, `courseLink`.`courseID` FROM `courseLink`
INNER JOIN `users` ON `users`.`userID` = `courseLink`.`userID`
WHERE `courseLink`.`courseID` = ?;";

require("_connect.php");

$stmt = mysqli_prepare($connect, $sequl);
mysqli_stmt_bind_param($stmt, "s", $courseID);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

while ($course = mysqli_fetch_assoc($result))
{
    echo "<tr>";

    echo "<td>" . $course['courseID'] . "</td>";
    echo "<td>" . $course['userID'] . "</td>";
    echo "<td>" . $course['firstname'] . "</td>";
    echo "<td>" . $course['lastname'] . "</td>";
    echo "<td>" . $course['email'] . "</td>";
    echo "<td>" . $course['JobRole'] . "</td>";
    echo "<td>" . $course['Rrle'] . "</td>";
    echo "<td>" .'<a href="./php/unenrol.php?userID=' . urlencode($course['userID']) . '&courseID=' . urlencode($courseID) . '" class="btn btn-secondary">Delete</a>' . "</td>";
    echo "</tr>";
}




?>