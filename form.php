<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktu Berria</title>
    <link rel="stylesheet" href="1ariketa.css">
    
</head>

<body>
<?php

$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml";

if (isset($_POST['izena'])) {
    $izena = $_POST['izena'];
} else {
    $izena = '';
}

if (isset($_POST['mota'])) {
    $mota = $_POST['mota'];
} else {
    $mota = '';
}

if (isset($_POST['prezioa'])) {
    $prezioa = $_POST['prezioa'];
} else {
    $prezioa = '';
}


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error);
} else {
    echo "Konektatuta zaude<br>";
}

if ($izena && $mota && $prezioa) {
    
    $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";

    
    if ($conn->query($sql) === TRUE) {
        echo "Produktu berria gehitu da!";
    } else {
        echo "Errorea gertatu da produktu berria gehitzen: " . $conn->error;
    }}

?>
    <h1>Produktu Berria Gehitu</h1>
    <form  method="POST">
        <label for="izena">Izena:</label>
        <input type="text" id="izena" name="izena" required>
        <br>
        <label for="mota">Mota:</label>
        <select id="mota" name="mota" required>
            <option value="Portatil">Portatil</option>
            <option value="Kontsola">Kontsola</option>
            <option value="Periferiko">Periferiko</option>
            <option value="Cascos">Cascos</option>
        </select>
        <br>
        <label for="prezioa">Prezioa:</label>
        <input type="number" id="prezioa" name="prezioa"  required>
        <br>
        <input type="submit" value="Gehitu">
    </form>
    <a href="1ariketa.php"><button>Bueltatu horrira</button></a>
</body>

</html>