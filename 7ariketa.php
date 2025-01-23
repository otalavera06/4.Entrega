<?php
$servername = "localhost"; // Zerbitzariaren izena
$username = "root"; // Erabiltzailearen izena
$password = "1MG2024"; // Pasahitza
$dbname = "ml"; // Datu-basearen izena

// MySQL konexioa sortu
$conn = new mysqli($servername, $username, $password, $dbname);

// Konexioaren errorea egiaztatu
if ($conn->connect_error) {
    die("Errorea konektatzean: " . $conn->connect_error); // Errorea badago, programa gelditu
}

// GET bidez bilaketarako eta motarako datuak jasotzen dira
$bilaketa = $_GET['bilaketa'] ?? ''; // Bilaketa hitza jasotzen da edo hutsik uzten da
$mota = $_GET['mota'] ?? ''; // Mota jasotzen da edo hutsik uzten da

// SQL kontsulta, bilaketa eta mota parametroak erabiliz
$sql = "SELECT * FROM produktuak WHERE izena LIKE '%$bilaketa%' AND mota LIKE '%$mota%'"; 
$result = $conn->query($sql); // Kontsulta exekutatzen da

// GET bidez "ezabatu" parametroa dagoen egiaztatu
if (isset($_GET['ezabatu'])) {
    $izena = $_GET['ezabatu']; // Ezabatu nahi den produktuaren izena jasotzen da

    // Ezabatzeko SQL kontsulta prestatzen da
    $sql = "DELETE FROM produktuak WHERE izena = '$izena'"; 

    // Kontsulta exekutatu eta emaitza egiaztatu
    if ($conn->query($sql) === TRUE) {
        header("Location: 7ariketa.php"); // Orria birkargatu
        die(); // Prozesua bukatu
    } else {
        echo "Errorea produktu bat ezabatzean: " . $conn->error; // Errorea erakutsi
    }
}
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8"> <!-- Orrialdearen karaktere-kodetzea -->
    <title>Ezabatu</title> <!-- Orrialdearen izenburua -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Kanpoko ikonoen liburutegia -->
    <link rel="stylesheet" href="1ariketa.css"> <!-- Kanpoko CSS esteka -->
</head>

<body>
    <h1>Produktua ezabatu</h1> <!-- Orrialdearen goiburua -->
    <form method="GET"> <!-- GET metodoarekin formularioa -->
        <a href=""> <!-- Plus ikonoa -->
            <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i>
        </a>
        <label for="bilaketa">Bilatu:</label> <!-- Bilaketa etiketa -->
        <input type="text" name="bilaketa" value="<?= $bilaketa ?>"> <!-- Bilaketa laukia -->
        <select name="mota"> <!-- Mota aukeraketa -->
            <option value="">Mota aukeratu</option> <!-- Lehenetsitako aukera -->
            <option value="Portatil" <?= $mota == "Portatil" ? "selected" : "" ?>>Portatil</option>
            <option value="Kontsola" <?= $mota == "Kontsola" ? "selected" : "" ?>>Kontsola</option>
            <option value="Periferiko" <?= $mota == "Periferiko" ? "selected" : "" ?>>Periferiko</option>
            <option value="Cascos" <?= $mota == "Cascos" ? "selected" : "" ?>>Cascos</option>
        </select>
        <input type="submit" value="Filtratu"> <!-- Filtratzeko botoia -->
    </form>
    <table> <!-- Taula -->
        <thead> <!-- Taulako goiburua -->
            <tr> <!-- Lerro bat -->
                <th>Izena</th> <!-- Izena zutabea -->
                <th>Mota</th> <!-- Mota zutabea -->
                <th>Prezioa</th> <!-- Prezioa zutabea -->
                <th>Ekintzak</th> <!-- Ekintzak zutabea -->
            </tr>
        </thead>
        <tbody> <!-- Taulako gorputza -->
            <?php
            if ($result->num_rows > 0) { // Lerroak badaude
                while ($row = $result->fetch_assoc()) { // Lerro bakoitzeko
                    echo "<tr>"; // Lerro berria ireki
                    echo "<td>" . $row['izena'] . "</td>"; // Izena zutabea
                    echo "<td>" . $row['mota'] . "</td>"; // Mota zutabea
                    echo "<td>" . $row['prezioa'] . "</td>"; // Prezioa zutabea
                    echo "<td> 
                            <a href=''> 
                                <i class='fas fa-pencil' title='Editatu'></i> 
                            </a> <!-- Editatzeko esteka -->
                            <a href='7ariketa.php?ezabatu=" . urlencode($row['izena']) . "' onclick=\"return confirm('Ziur zaude ezabatu nahi duzula?');\"> 
                                <i class='fas fa-trash' title='Ezabatu'></i> 
                            </a> <!-- Ezabatzeko esteka -->
                          </td>";
                    echo "</tr>"; // Lerroa itxi
                }
            } else { // Lerroak ez badaude
                echo "<tr><td colspan='4'>Ez da produktu bat aurkitu.</td></tr>"; // Mezua taulan
            }
            ?>
        </tbody>
    </table>
</body>

</html>
