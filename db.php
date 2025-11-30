<?php
$servername = "nazwa_serwera_mysql"; // np. podana w Azure Web App
$username = "username";
$password = "password";
$dbname = "nazwa_bazy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>