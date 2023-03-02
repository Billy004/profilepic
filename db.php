<?php
//connect to database if error show error and exit
$conn = new mysqli('localhost','root','','pic');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>