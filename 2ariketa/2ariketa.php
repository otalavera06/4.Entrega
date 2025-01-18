<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktu Zerrenda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../ariketak.css">
</head>

<body>
    <?php
    require_once("../db.php");

    $bilaketa = '';
    if (isset($_GET['bilaketa'])) {
        $bilaketa = $_GET['bilaketa'];
    }
    
    // bilaketaren filtroa aplikatu dezan bakarrik aldaketa kodean
    if ($bilaketa != '') {
        $sql = "SELECT id, izena, mota, prezioa FROM produktuak WHERE izena LIKE '%$bilaketa%'";
    }else {
        $sql = "SELECT id, izena, mota, prezioa FROM produktuak";
    }

    $result = $conn->query($sql);
    ?>

    <h1>Produktu Zerrenda</h1>

    <!-- Akzioa aldatu diot fitxategi bakoitzak bere filtroei begiratzeko -->
    <form action="2ariketa.php" method="GET">

        <label for="bilaketa">Bilatu:</label>
        <input type="text" class="bilaketa" name="bilaketa" id="bilaketa" value="<?php echo $bilaketa; ?>">
        <input type="submit" value="Filtratu">
        <select id="mota" name="mota">
            <option></option>
            <option value="Portatil">Portatil</option>
            <option value="Kontsola">Kontsola</option>
            <option value="Periferiko">Periferiko</option>
            <option value="Cascos">Cascos</option>
        </select>
    </form> <br>

    <a href="2ariketainsert.php"> <!-- esteka bat ezarrita dago 5ariketa.php ra eramango diona -->
        <!-- ikono bat txertatu du eta izenburua ezarri dio gainean zaudenean testua agertu dadin -->
        <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i>
    </a> <!-- a etiketa itxi da -->

    <table> <!-- taula bat sortu du -->
        <thead> <!-- taularen buruaren atala definitzeko etiketa ireki du -->
            <tr> <!-- taulan lerro bat erantsi du -->
                <th>Izena</th> <!-- Izena testua izango duen errenkada sortu du -->
                <th>Mota</th> <!-- Mota testua izango duen errenkada sortu du -->
                <th>Prezioa</th> <!-- Prezioa testua izango duen errenkada sortu du -->
                <th>Ekintzak</th> <!-- Ekintzak testua izango duen errenkada sortu du -->
            </tr> <!-- lerroa amaitu egiten du -->
        </thead> <!-- taularen buruaren atala itxi du -->
        <tbody> <!-- taularen gorputzaren atala definitzeko etiketa ireki du -->
            <?php // php etiketa ireki du
                
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['izena'] . "</td>";
                    echo "<td>" . $row['mota'] . "</td>";
                    echo "<td>" . $row['prezioa'] . "</td>";
                    echo "<td>
                            <a href=\"2ariketaupdate.php?id=" . $row["id"] . "\">
                                <i class='fas fa-pencil' title='Editatu'></i>
                            </a>
                            <a href=\"2ariketadelete.php?id=" . $row["id"] . "\">
                                <i class='fas fa-trash' title='Ezabatu'></i>
                            </a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Ez da produktu bat aurkitu.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>