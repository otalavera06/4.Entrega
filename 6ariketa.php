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
    die("Errorea konektatzean: " . $conn->connect_error);
}

// SQL kontsulta definitu, produktuak guztiak eskuratzeko
$sql = "SELECT * FROM produktuak";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8"> <!-- Dokumentuaren karaktere-kodeketa -->
    <title>Editatu</title> <!-- Orriaren izenburua -->
    <!-- Font Awesome estiloak gehitu, ikonoak erabiltzeko -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS fitxategi lokal bat gehitu -->
    <link rel="stylesheet" href="1ariketa.css">
</head>

<body>
    <h1>Produktu Zerrenda</h1> <!-- Orriaren izenburua -->

    <!-- Produktuen taula -->
    <table>
        <thead>
            <tr>
                <th>Izena</th> <!-- Zutabea: Produktuaren izena -->
                <th>Mota</th> <!-- Zutabea: Produktuaren mota -->
                <th>Prezioa</th> <!-- Zutabea: Produktuaren prezioa -->
                <th>Editatu</th> <!-- Zutabea: Ekintza -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['izena']) ?></td> <!-- Produktuaren izena -->
                    <td><?= htmlspecialchars($row['mota']) ?></td> <!-- Produktuaren mota -->
                    <td><?= htmlspecialchars($row['prezioa']) ?></td> <!-- Produktuaren prezioa -->
                    <td>
                        <!-- Editatzeko botoia -->
                        <a
                            href='editatu.php?id=<?= $row["id"] ?>&izena=<?= urlencode($row["izena"]) ?>&mota=<?= urlencode($row["mota"]) ?>&prezioa=<?= $row["prezioa"] ?>'>
                            <i class="fas fa-pencil-alt"></i> <!-- Editatzeko arkatzaren ikonoa -->
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?> <!-- While amaiera -->
        </tbody>
    </table>
</body>

</html>