<?php
// Zerbitzariaren izena eta konektatzeko datuak definitu
$servername = "localhost";
$username = "root";
$password = "1MG2024";
$dbname = "ml";

// MySQL zerbitzariarekin konektatzeko objektua sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konektatzean erroreak egiaztatu
if ($conn->connect_error) {
    // Errorea badago, mezua erakutsi eta exekuzioa eten
    die("Errorea konektatzean: " . $conn->connect_error);
}

// GET metodoaren bidez jasotako parametroak esleitu, hutsik utzi baliorik ez badute
$bilaketa = $_GET['bilaketa'] ?? ''; // 'bilaketa' parametroa
$mota = $_GET['mota'] ?? '';         // 'mota' parametroa

// SQL kontsulta definitu, izenaren eta motaren arabera produktuak bilatzeko
$sql = "SELECT * FROM produktuak WHERE izena LIKE '%$bilaketa%' AND mota LIKE '%$mota%'";

// Kontsulta exekutatu eta emaitzak lortu
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8"> <!-- Dokumentuaren karaktere-kodeketa -->
    <title>Gehitu</title> <!-- Orriaren izenburua -->
    <!-- Font Awesome estiloak gehitu, ikonoak erabiltzeko -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS fitxategi lokal bat gehitu -->
    <link rel="stylesheet" href="1ariketa.css">
</head>

<body>
    <h1>Produktua Gehitu</h1> <!-- Orriaren izenburua -->

    <!-- Bilaketa eta gehitzeko formularioa -->
    <form method="GET">
        <a href="gehitu.php">
            <!-- Plus ikonoa produktu berriak gehitzeko -->
            <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i>
        </a>
        <label for="bilaketa">Bilatu:</label> <!-- Bilaketa-eremurako etiketa -->
        <input type="text" name="bilaketa" value="<?= $bilaketa ?>"> 
        <!-- Bilaketa egiteko textu kutxa, azken bilaketa aurrez beteta -->
        
        <!-- Mota aukeratzeko aukera zerrenda -->
        <select name="mota">
            <option value="">Mota aukeratu</option> <!-- Aukera hutsa -->
            <option value="Portatil" <?= $mota == "Portatil" ? "selected" : "" ?>>Portatil</option>
            <option value="Kontsola" <?= $mota == "Kontsola" ? "selected" : "" ?>>Kontsola</option>
            <option value="Periferiko" <?= $mota == "Periferiko" ? "selected" : "" ?>>Periferiko</option>
            <option value="Cascos" <?= $mota == "Cascos" ? "selected" : "" ?>>Cascos</option>
        </select>
        <input type="submit" value="Filtratu"> <!-- Formularioa bidaltzeko botoia -->
    </form>

    <!-- Produktuen taula -->
    <table>
        <thead>
            <tr>
                <th>Izena</th> <!-- Zutabea: Produktuaren izena -->
                <th>Mota</th> <!-- Zutabea: Produktuaren mota -->
                <th>Prezioa</th> <!-- Zutabea: Produktuaren prezioa -->
                <th>Ekintzak</th> <!-- Zutabea: Ekintzak -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['izena'] ?></td> <!-- Produktuaren izena -->
                    <td><?= $row['mota'] ?></td> <!-- Produktuaren mota -->
                    <td><?= $row['prezioa'] ?></td> <!-- Produktuaren prezioa -->
                    <td>
                        <!-- Editatzeko ikonoa -->
                        <a href=""><i class="fas fa-pencil-alt"></i></a>
                        <!-- Ezabatzeko ikonoa -->
                        <a href=""><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?> <!-- While bukatu -->
        </tbody>
    </table>
</body>

</html>
