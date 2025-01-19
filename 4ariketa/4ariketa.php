<!DOCTYPE html> <!-- Fitxategi HTML bat izango da -->
<html lang="eu"> <!-- Dokumentuaren hizkuntza definitzen du -->

<head> <!-- Head etiketa irekiten du -->
    <meta charset="UTF-8"> <!-- UTF-8 kodifikazioa erabiliko du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Pantailaren neurriak zein izango diren definitzen ditu -->
    <title>Produktu Zerrenda</title> <!-- Izenburua jarri dio web orriaren hasiera-leiatilan agertuko dena -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- CSS dei bat egiten du ikonoen irudiak erakusteko -->
    <link rel="stylesheet" href="../ariketak.css">
    <!-- CSS dei bat egiten dio ariketak izeneko fitxategian definituriko estiloa eduki dezan -->
</head> <!-- Head etiketa itxi du -->

<body> <!-- Body etiketa irekiten du -->
    <?php // PHP etiketa irekiten du
    require_once("../db.php"); // Refaktorizatuta konexioa egiten du gure datu basearekin
    
    $mota = ''; // Mota aldagaia sortu du balio huts batekin
    $bilaketa = ''; // Bilaketa aldagaia sortu du balio huts batekin
    
    if (isset($_GET['mota'])) { // motan zerbait idatzita baldin badago, exekutatuko den kodea
        $mota = $_GET['mota']; // Motaren balio berria aldagaian gorde da
    } // Kondizioa betetzen den exekutatuko den kodea amaitzen da
    
    if (isset($_GET['bilaketa'])) { // bilaketan zerbait idatzita baldin badago, exekutatuko den kodea
        $bilaketa = $_GET['bilaketa']; // Bilaketaren balio berria aldagaian gorde da
    } // Kondizioa betetzen den exekutatuko den kodea amaitzen da
    
    // sql Kontsultak aldatu ditut bi filtroa batera egin dezaten "and erabiliz"
    if ($bilaketa != '' && $mota != '') { // Bilaketaren eta motaren balioak ez badira hutsak, exekutatuko den kodea     
        $sql = "SELECT id, izena, mota, prezioa FROM produktuak WHERE izena LIKE '%$bilaketa%' and mota = '$mota'"; // SQL kontsulta bilaketa egingo duena bilaketaren eta motarenarabera
    } elseif ($bilaketa != '') { // Bilaketaren balioa ez bada hutsa, exekutatuko den kodea
        $sql = "SELECT id, izena, mota, prezioa FROM produktuak WHERE izena LIKE '%$bilaketa%'"; // SQL kontsulta bilaketa egingo duena bilaketaren arabera
    } elseif ($mota != '') { // Motaren balioa ez bada hutsa, exekutatuko den kodea
        $sql = "SELECT id, izena, mota, prezioa FROM produktuak WHERE mota = '$mota'"; // SQL kontsulta bilaketa egingo duena motaren arabera
    } else { // Ez badu baliorik exekutatuko den kodea
        $sql = "SELECT id, izena, mota, prezioa FROM produktuak"; // Baldintzarik gabeko sql kontsulta
    } // Kondizioa betetzen ez denean exekutatuko den kodea amaitzen da
    
    $result = $conn->query($sql); // SQL kontsulta exekutatzen du
    ?> <!-- PHP etiketa itxi du -->
    <h1>Produktu Zerrenda</h1> <!-- h1 etiketa ireki du izenburu bat ezartzeko web orria zertarako den jakiteko -->

    <!-- Akzioa aldatu diot fitxategi bakoitzak bere filtroei begiratzeko -->
    <form action="4ariketa.php" method="GET">
        <!-- formularioa irekitzen du get metodoa erabiliz bere buruari deituko diona -->

        <label for="bilaketa">Bilatu:</label> <!-- bilateka izenako labela sortu du -->
        <input type="text" class="bilaketa" name="bilaketa" id="bilaketa" value="">
        <!-- input-a sortu du bilaketarentzat -->
        <select id="mota" name="mota">
            <!-- mota izeneko select-a sortu du gure mota ezberdinen desplegablea izango dena -->
            <!-- desplegableak izango dituen aukerak definitu ditu -->
            <option></option> <!-- defektuzko hutsa -->
            <option value="Portatil">Portatil</option> <!-- portatilarentzat portatil balorea izango duena -->
            <option value="Kontsola">Kontsola</option> <!-- Kontsolarentzat kontsola balorea izango duena -->
            <option value="Periferiko">Periferiko</option> <!-- Periferikoentzat periferiko balorea izango duena -->
            <option value="Cascos">Cascos</option> <!-- Aurikularrarentzat cascos balorea izango duena -->
        </select> <!-- desplegablea itxi du -->
        <input type="submit" value="Filtratu"> <!-- botoi bat sortu du filtroa aplikatzeko -->
    </form> <br> <!-- formularioa itxi du eta ilara salto bat ezarri du -->


    <a href="4ariketainsert.php"> <!-- esteka bat ezarrita dago 4ariketainsert.php ra eramango diona -->
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
            
            if ($result->num_rows > 0) { // Egindako kontsularen ilara kopurua 0 baino handiago den kondizioa
                while ($row = $result->fetch_assoc()) { // Kondizioa betetzean, erantzun bakoitzarentzat aplikatuko den buklea
                    echo "<tr>"; // tr etiketa bat ireki du
                    echo "<td>" . $row['izena'] . "</td>"; // Lehen zutabean produktuaren izena erakutsiko du
                    echo "<td>" . $row['mota'] . "</td>"; // Bigarren zutabean produktu mota erakutsiko du
                    echo "<td>" . $row['prezioa'] . "</td>"; // Hirugarren zutabean produktu prezioa
                    // 4 zutabean 2 ikono txertatu ditu esteka bat dute ikono bakoitza, lehena produktua editatzeko eta bestea ezabatzeko ikono irudiak erabiliz
                    echo "<td>
                            <a href=\"4ariketaupdate.php?id=" . $row["id"] . "\">
                                <i class='fas fa-pencil' title='Editatu'></i>
                            </a>
                            <a href=\"4ariketadelete.php?id=" . $row["id"] . "\">
                                <i class='fas fa-trash' title='Ezabatu'></i>
                            </a>
                          </td>";
                    echo "</tr>";
                } // Buklea amaitzen da
            } else { // Ez bada kondizioa betetzen (0 ilara baino gehiago), exekutatuko den kodea
                echo "<tr><td colspan='4'>Ez da produktu bat aurkitu.</td></tr>"; // Errore mezua erakutsiko du 4 zutabeak elkartuz
            } // Kondizioa betetzen ez denean, exekutatuko den kodea amaitzen da
            ?> <!-- PHP etiketa itxi du -->
        </tbody> <!-- Taularen body etiketa itxi du -->
    </table> <!-- Taula amaitzen du -->
</body> <!-- Dokumentuaren gorputzaren etiketa itxi du -->

</html> <!-- HTML etiketa itxi du eta amaitzen da web orria -->