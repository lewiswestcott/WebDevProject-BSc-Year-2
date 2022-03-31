<?php

require("_connect.php");

$uuid = $_POST["courseID"];
$sql="SELECT * FROM `course` WHERE `courseID` = $uuid";

$query = mysqli_query($connect, $sql);

$result = mysqli_fetch_assoc($query);

echo JSON_encode($result);
return;



?>
