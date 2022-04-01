<?php
if (!file_exists('data.txt'))
{
    die("<li>No Data</li>");
}

$messages = file('data.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

foreach ($messages as $message)
{
    echo "<li>" . htmlentities($message) . "</li>";
}

?>