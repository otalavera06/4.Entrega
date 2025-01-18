<?php
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error);
}

?>