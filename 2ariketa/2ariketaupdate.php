<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editatu Produktua</title>
    <link rel="stylesheet" href="../ariketak.css">
</head>

<body>
    <?php
    require_once("../db.php");

    $idProduktua = "";
    $izena = "";
    $mota = "";
    $prezioa = "";

    if (isset($_GET["id"]) && !empty($_GET["id"])) {
        $idProduktua = ($_GET["id"]);
    }

    $bistaratu = "SELECT id, izena, mota, prezioa FROM produktuak WHERE id = '$idProduktua'";
    $result = $conn->query($bistaratu);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $izena = $row["izena"];
        $mota = $row["mota"];
        $prezioa = $row["prezioa"];
    }

    ?>
    <!-- Erabiltzaileak id-a aldatzeko aukera zuen, kasu honetan ezin izan beharko genuke produktuaren id-a aldatu -->
    <form method="post">
        <br>
        <label for="izena"><strong>Erregistroa sartu: </strong></label>
        <br>
        <input type="text" name="izena" id="izena" value="<?php echo $izena ?>" placeholder="sartu izena" />
        <select id="mota" name="mota" required>
            <option value="Portatil" <?php if ($mota == 'Portatil') echo 'selected'; ?>>Portatil</option>
            <option value="Kontsola" <?php if ($mota == 'Kontsola') echo 'selected'; ?>>Kontsola</option>
            <option value="Periferiko" <?php if ($mota == 'Periferiko') echo 'selected'; ?>>Periferiko</option>
            <option value="Cascos" <?php if ($mota == 'Cascos') echo 'selected'; ?>>Cascos</option>
        </select>
        <input type="number" name="prezioa" step="any" id="prezioa" value="<?php echo $prezioa ?>" placeholder="..€">
        <button name="editatubotoia">Sartu</button>
    </form>

    <?php
    if (isset($_POST['editatubotoia'])) {
        $izena = $_POST['izena'];
        $mota = $_POST['mota'];
        $prezioa = $_POST['prezioa'];

        $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$idProduktua'";

        if ($conn->query($sql) === TRUE) {
            header("Location: 2ariketa.php");
            exit();
        } else {
            echo "Arazoak taula eguneratzean: " . $conn->error;
        }
    }

    $conn->close();
    ?>
</body>

</html>