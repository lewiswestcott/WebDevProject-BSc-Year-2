<?php
if (!isset($_POST['msg']))
{
    die("No Message");
}

$value = date('H:i:s'). ' - ' . $_POST['msg'];

file_put_contents('data.txt', PHP_EOL . $value, FILE_APPEND);