<?php
// Zerbitzariaren izena definitu
$servername = "localhost";

// Datu-baseko erabiltzailearen izena definitu
$username = "root";

// Datu-basearen pasahitza definitu
$password = "1MG2024";

// Erabiliko den datu-basearen izena definitu
$dbname = "ml";

// MySQL zerbitzariarekin konektatzeko objektua sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konektatzean erroreak egiaztatu
if ($conn->connect_error) {
    // Errorea badago, mezua erakutsi eta exekuzioa eten
    die("Errorea konektatzean: " . $conn->connect_error);
}

// GET metodoaren bidez jasotako 'bilaketa' parametroa esleitu, hutsik utzi baliorik ez badu
$bilaketa = $_GET['bilaketa'] ?? '';

// GET metodoaren bidez jasotako 'mota' parametroa esleitu, hutsik utzi baliorik ez badu
$mota = $_GET['mota'] ?? '';

// SQL kontsulta definitu, bilaketaren eta motaren arabera produktuak bilatzeko
$sql = "SELECT * FROM produktuak WHERE izena LIKE '%$bilaketa%' AND mota LIKE '%$mota%'";

// Kontsulta exekutatu eta emaitzak lortu
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8"> <!-- Dokumentuaren karaktere-kodeketa definitu -->
    <title>Mota eta Bilaketa</title> <!-- Orriaren izenburua definitu -->
    <!-- Font Awesome estiloak gehitu, ikonoak erabiltzeko -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS fitxategi lokal bat gehitu -->
    <link rel="stylesheet" href="1ariketa.css">
</head>

<body>
    <h1>Mota eta Bilaketaren arabera filtratu</h1> <!-- Orriaren izenburua -->

    <!-- Bilaketa egiteko formularioa -->
    <form method="GET"> <!-- GET metodoa erabiliko da -->
        <a href="">
            <!-- Plus ikonoa gehitu produktu berriak gehitzeko -->
            <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i>
        </a>
        <label for="bilaketa">Bilatu:</label> <!-- Bilaketa-eremurako etiketa -->
        <input type="text" name="bilaketa" value="<?= $bilaketa ?>"> 
        <!-- Bilaketa egiteko textu kutxa, defektuz azken bilaketa agertzen da -->

        <!-- Mota aukeratzeko aukera zerrenda -->
        <select name="mota">
            <option value="">Mota aukeratu</option> <!-- Aukera hutsa, defektuz agertuko dena -->
            <!-- Aukera bakoitzaren egoera egiaztatu, aurrez aukeratua badago, 'selected' atributua gehitu -->
            <option value="Portatil" <?= $mota == "Portatil" ? "selected" : "" ?>>Portatil</option>
            <option value="Kontsola" <?= $mota == "Kontsola" ? "selected" : "" ?>>Kontsola</option>
            <option value="Periferiko" <?= $mota == "Periferiko" ? "selected" : "" ?>>Periferiko</option>
            <option value="Cascos" <?= $mota == "Cascos" ? "selected" : "" ?>>Cascos</option>
        </select>

        <input type="submit" value="Filtratu"> <!-- Formularioa bidaltzeko botoia -->
    </form>

    <!-- Produktuen taula erakusteko atala -->
    <table>
        <thead> <!-- Taularen goiburua -->
            <tr>
                <th>Izena</th> <!-- Zutabearen izenburua: Izena -->
                <th>Mota</th> <!-- Zutabearen izenburua: Mota -->
                <th>Prezioa</th> <!-- Zutabearen izenburua: Prezioa -->
                <th>Ekintzak</th> <!-- Zutabearen izenburua: Ekintzak -->
            </tr>
        </thead>
        <tbody> <!-- Taularen gorputza -->
            <?php while ($row = $result->fetch_assoc()): ?> 
                <!-- MySQL-etik datu bat jaso eta lerro bakoitzeko balioak erakutsi -->
                <tr>
                    <td><?= $row['izena'] ?></td> <!-- Produktuaren izena erakutsi -->
                    <td><?= $row['mota'] ?></td> <!-- Produktuaren mota erakutsi -->
                    <td><?= $row['prezioa'] ?></td> <!-- Produktuaren prezioa erakutsi -->
                    <td>
                        <!-- Editatzeko ikonoa -->
                        <a href=""><i class="fas fa-pencil-alt"></i></a>
                        <!-- Ezabatzeko ikonoa -->
                        <a href=""><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            <?php endwhile; ?> <!-- While bukatu -->
        </tbody> <!-- Taularen gorputza itxi -->
    </table>
</body>

</html>
