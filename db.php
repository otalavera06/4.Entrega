<?php // Php etiketa ireki du
$servername = "localhost"; // Datu basearen zerbitzariaren kokalekua definitu du
$username = "root"; // Zerbitzariko erabiltzailea definitu du
$password = "1MG2024"; // Erabiltzailearen pasahitza definitu du
$dbname = "ml"; // Datu basea definitu du

$conn = new mysqli($servername, $username, $password, $dbname); // Konexioa egiten du

if ($conn->connect_error) { // Konexioa ez bada egiten kondizioa sartu du
    die("Errorea konektatzean: " . $conn->connect_error); // Konexio errore mezua emango du
} // Kondizioa amaitzen da

?> <!-- Php etiketa itxi du -->