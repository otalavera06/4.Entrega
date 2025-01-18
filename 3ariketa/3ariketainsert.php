<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktu Berria</title>
    <link rel="stylesheet" href="../ariketak.css">

</head>

<body>
    <?php

    require_once("../db.php");

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

    if ($izena && $mota && $prezioa) {

        $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')";


        if ($conn->query($sql) === TRUE) {
            header("Location: 3ariketa.php");
            exit();
        } else {
            echo "Errorea gertatu da produktu berria gehitzen: " . $conn->error;
        }
    }

    ?>
    <h1>Produktu Berria Gehitu</h1>
    <form method="POST">
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
        <input type="number" step="any" id="prezioa" name="prezioa" required>
        <br>
        <input type="submit" value="Gehitu">
    </form>
</body>

</html>