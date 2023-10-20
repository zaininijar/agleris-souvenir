<?php

$host = "localhost";
$username = "root";
$password = "";
$db_name = "agleris_souvenir";
$conn = mysqli_connect($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection Error : " . $conn->connect_error);
}
