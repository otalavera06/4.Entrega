<?php
// Zerbitzariaren izena definitu
$servername = "localhost"; 

// Datu-baseko erabiltzailearen izena definitu
$username = "root"; 

// Datu-basearen pasahitza definitu
$password = "1MG2024"; 

// Eskemaren izena definitu
$dbname = "ml"; 

// Koneksioa sortu
$conn = new mysqli($servername, $username, $password, $dbname); 

// Erroreak egiaztatu
if ($conn->connect_error) { 
    // Errorea badago, errore mezua erakutsi eta amaitu
    die("Errorea konektatzean: " . $conn->connect_error); 
}

// bilaketa parametroa aldagai batean gorde, baliorik ez badu, hutsik utzi
$bilaketa = $_GET['bilaketa'] ?? ''; 

// SQL kontsulta
$sql = "SELECT * FROM produktuak WHERE izena LIKE '%$bilaketa%'"; 

// Kontsulta egin
$result = $conn->query($sql); 
?>
<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8"> <!-- Dokumentuaren karaktere-kodeketa definitu -->
    <title>Produktu Bilaketa</title> <!-- Orriaren izenburua definitu -->
    <!-- ikonoak erabiltzeko -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- estiloak gehitu -->
    <link rel="stylesheet" href="1ariketa.css">
</head>

<body>
    <h1>Bilaketa</h1> <!-- Orriaren izenburua -->

    <!-- Bilaketa egiteko formularioa -->
    <form method="GET"> <!-- GET metodoa erabiliko da -->
        <a href=""> 
            <!-- Plus ikonoa -->
            <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i>
        </a>
        <label for="bilaketa">Bilatu:</label> <!-- Bilaketa-eremurako etiketa -->
        <input type="text" class="bilaketa" name="bilaketa" id="bilaketa" value="<?php echo $bilaketa; ?>"> 
        <!-- Bilaketa egiteko textu kutxa. Lehendik bilaketa egon bada, haren balioa erakutsiko du -->

        <input type="submit" value="Filtratu"> <!-- Bilaketa bidaltzeko botoia -->

        <!-- Mota aukeratzeko aukera zerrenda -->
        <select id="mota" name="mota"> 
            <option></option> <!-- Aukera hutsa, defektuz agertuko dena -->
            <option value="Portatil">Portatil</option> <!-- Aukera bat: Portatil -->
            <option value="Kontsola">Kontsola</option> <!-- Aukera bat: Kontsola -->
            <option value="Periferiko">Periferiko</option> <!-- Aukera bat: Periferiko -->
            <option value="Cascos">Cascos</option> <!-- Aukera bat: Cascos -->
        </select> <!-- Select etiketa itxi -->
    </form> <!-- Formularioa itxi -->

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
