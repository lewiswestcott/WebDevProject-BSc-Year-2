<?php

require("_connect.php");

$uuid = $_POST["userID"];
$sql="SELECT * FROM `users` WHERE `userID` = $uuid";

$query = mysqli_query($connect, $sql);

$result = mysqli_fetch_assoc($query);

echo JSON_encode($result);
return;

?>
