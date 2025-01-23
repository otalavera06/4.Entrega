<?php
$servername = "localhost"; // Zerbitzariaren izena
$username = "root"; // Erabiltzailearen izena
$password = "1MG2024"; // Erabiltzailearen pasahitza
$dbname = "ml"; // Datu-basearen izena

// MySQL konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioaren errorea egiaztatu
if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error); // Errorea badago, programa gelditu
}

// GET bidez jasotako datuak gordetzen dira
$id = $_GET['id'] ?? ''; // Produktuaren IDa jasotzen da, hutsik badator balio lehenetsia ''
$izena = $_GET['izena'] ?? ''; // Produktuaren izena jasotzen da edo hutsik uzten da
$mota = $_GET['mota'] ?? ''; // Produktuaren mota jasotzen da edo hutsik uzten da
$prezioa = $_GET['prezioa'] ?? ''; // Produktuaren prezioa jasotzen da edo hutsik uzten da

// POST metodoarekin formularioa bidali denean
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Produktuaren IDa formularioan bidalitako datuetatik
    $izena = $_POST['izena']; // Produktuaren izena formularioan bidalitako datuetatik
    $mota = $_POST['mota']; // Produktuaren mota formularioan bidalitako datuetatik
    $prezioa = $_POST['prezioa']; // Produktuaren prezioa formularioan bidalitako datuetatik

    // Datuak eguneratzeko SQL kontsulta
    $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$id'";

    // Kontsulta exekutatu eta emaitza egiaztatu
    if ($conn->query($sql) === TRUE) {
        echo "Erregistroa arrakastaz eguneratu da!"; // Arrakasta-mezua
    } else {
        echo "Errorea eguneratzean: " . $conn->error; // Errorea badago, errore-mezua
    }
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8"> <!-- Orriaren karaktere-kodetzea -->
    <title>Editatu Produktua</title> <!-- Orriaren izenburua -->
    <link rel="stylesheet" href="1ariketa.css"> <!-- Kanpoko CSS fitxategia lotzen da -->
</head>

<body>
    <h1>Produktu Editatu</h1> <!-- Orriaren goiburua -->
    <form method="POST"> <!-- Formularioa POST metodoarekin -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>"> <!-- Produktuaren IDa ezkutuan gordetzen da -->
        <label for="izena">Izena:</label> <!-- Izena sartzeko etiketa -->
        <input type="text" name="izena" id="izena" value="<?= htmlspecialchars($izena) ?>" required> <!-- Izena sartzeko laukia -->
        <br>
        <label for="mota">Mota:</label> <!-- Mota aukeratzeko etiketa -->
        <select id="mota" name="mota" required> <!-- Aukeraketa zerrenda -->
            <option value="Portatil" <?= $mota === 'Portatil' ? 'selected' : '' ?>>Portatil</option> <!-- Portatil mota -->
            <option value="Kontsola" <?= $mota === 'Kontsola' ? 'selected' : '' ?>>Kontsola</option> <!-- Kontsola mota -->
            <option value="Periferiko" <?= $mota === 'Periferiko' ? 'selected' : '' ?>>Periferiko</option> <!-- Periferiko mota -->
            <option value="Cascos" <?= $mota === 'Cascos' ? 'selected' : '' ?>>Cascos</option> <!-- Cascos mota -->
        </select>
        <br>
        <label for="prezioa">Prezioa:</label> <!-- Prezioa sartzeko etiketa -->
        <input type="number" name="prezioa" id="prezioa" value="<?= htmlspecialchars($prezioa) ?>" required> <!-- Prezioa sartzeko laukia -->
        <br>
        <input type="submit" value="Eguneratu"> <!-- Eguneratu botoia -->
    </form>
    <a href="6ariketa.php"><button>Bueltatu orrira</button></a> <!-- Orrira itzultzeko botoia -->
</body>

</html>
