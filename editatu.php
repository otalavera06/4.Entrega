<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editatu Produktua</title>
    <link rel="stylesheet" href="1ariketa.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1MG2024";
    $dbname = "ml";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Errorea konektatzean: " . $conn->connect_error);
    }

    $row = "";
$idProduktua="";
$izena = "";
$mota = "";
$prezioa = "";
if (isset($_GET["izena"])) {
    $izena = ($_GET["izena"]);
}
if (isset($_GET["idProduktua"])) {
    $idProduktua = ($_GET["idProduktua"]);
}
if (isset($_GET["mota"])) {
    $mota = ($_GET["mota"]);
}
if (isset($_GET["prezioa"])) {
    $prezioa = ($_GET["prezioa"]);
}
?>
 
<form  method="get">
    <br>
    <label for="izena"> <strong>Erregistroa sartu: </strong></label>
    <br>
    <input type="text" name="idProduktua" id="idProduktua" value="" placeholder="sartu id-a" />
    <input type="text" name="izena" id="izena" value="" placeholder="sartu izena" />
    <select id="mota" name="mota" required>
            <option value="Portatil">Portatil</option>
            <option value="Kontsola">Kontsola</option>
            <option value="Periferiko">Periferiko</option>
            <option value="Cascos">Cascos</option>
        </select>
    <input type="number" name="prezioa" id="prezioa" value="" placeholder="..€">
    <button>Sartu</button>
</form>
<a href="1ariketa.php"><button>Bueltatu horrira</button></a>
 

 
 <?php
 $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE idProduktua='$idProduktua'";
 
 if ($conn->query($sql) === TRUE) {
     echo "Record updated successfully";
 } else {
     echo "Error updating record: " . $conn->error;
 }

 $conn->close();
?>