<?php // php etiketa irekitzen du

require_once("db.php"); // Refaktorizatuta konexioa egiten du gure datu basearekin

$id = ""; // id aldagaia sortzen du balio hutsarekin

if (isset($_GET["id"]) && !empty($_GET["id"])) { // id-a baldin badago eta ez bada hutsa, kondizioa beteko duen kode zatia
    $id = $_GET["id"]; // id-aren balio berria aldagaian gorde da
} // exekutatuko den kodea amaitu du


$sql = "DELETE FROM produktuak WHERE id='$id';"; // SQL kontsulta aukeratutakoa ezabatzeko

if ($conn->query($sql) === TRUE) { // SQL kontsulta ongi egin den, kondizioa beteko duen kodea
    header("Location: 1ariketa.php"); // Kondizioa betetzen denean 2 ariketara bueltatuko gara
} else { // kondizioa ez bada betetzen, exekutatuko den kode zatia
    echo "Arazoa erregistroa ezabatzean: " . $conn->error; // Arazo mezu bat emango dio
} // Kondizioa betetzen ez denean, exekutatuko den kodea amaitzen da

$conn->close(); // datu basearekin konexioa itxi da

?> <!-- Php etiketa itxi du -->