<!DOCTYPE html> <!-- fitxategia html bat izango da -->
<html lang="eu"> <!-- dokumentuaren hizkuntza definitzen du -->

<head> <!-- head etiketa irekutzen du -->
    <meta charset="UTF-8"> <!-- UTF-8 kodifikazioa erabiliko du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Pantailaren neurriak zein izango diren definitu ditu -->
    <title>Produktu Zerrenda</title> <!-- Izenburua jarri dio web orriaren hasiera-leiatilan agertuko dena -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Css dei bat egiten du ikonoen irudiak erakusteko -->
    <link rel="stylesheet" href="ariketak.css">
    <!-- Css dei bat egiten dio ariketak izeneko fitxategian definituriko estiloa eduki dezan -->
</head> <!-- head etiketa itxi du -->

<body> <!-- body etiketa irekitzen du -->
    <?php // php etiketa irekitzen du
    require_once("db.php"); // Refaktorizatuta konexioa egiten du gure datu basera
    
    $sql = "SELECT id, izena, mota, prezioa FROM produktuak"; // sql eskaera egiten du produktu guztien zerrenda erakusteko
    
    $result = $conn->query($sql); // sql kontsulta exekutatu egiten du
    ?> <!-- Php etiketa itxi du -->

    <h1>Produktu Zerrenda</h1> <!-- h1 etiketa sortu du izenburua jartzeko web orrian -->

    <!-- Akzioa aldatu diot fitxategi bakoitzak bere filtroei begiratzeko -->
    <form action="1ariketa.php" method="GET">
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

    <a href="5ariketa.php"> <!-- esteka bat ezarrita dago produktua gehitzeko fitxategira eramango diona -->
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
            
            if ($result->num_rows > 0) { // egindako kontsularen ilara kopurua 0 baino handiago den kondizioa
                while ($row = $result->fetch_assoc()) { // kondizioa betetzezn bada erantzun bakoitzarentzat aplikatuko den buklea
                    echo "<tr>"; // tr etiketa bat ireki du
                    echo "<td>" . $row['izena'] . "</td>"; // lehen zutabean produktuaren izena erakutsiko du
                    echo "<td>" . $row['mota'] . "</td>"; // bigarren zutabean produktu mota erakutsiko du
                    echo "<td>" . $row['prezioa'] . "</td>"; // hirugarren zutabean produktu prezioa
                    // 4 zutabean 2 ikono txertatu ditu esteka bat dute ikono bakoitza, lehena produktua editatzeko eta bestea ezabatzeko ikono irudiak erabiliz
                    echo "<td> 
                            <a href=\"6ariketa.php?id=" . $row["id"] . "\"> 
                                <i class='fas fa-pencil' title='Editatu'></i>
                            </a>
                            <a href=\"7ariketa.php?id=" . $row["id"] . "\">
                                <i class='fas fa-trash' title='Ezabatu'></i>
                            </a>
                          </td>";
                    echo "</tr>";
                } // buklea amaitzen da
            } else { // ez bada kondizioa betetzen (0 ilara baina gehiago) exekutatuko den kodea
                echo "<tr><td colspan='4'>Ez da produktu bat aurkitu.</td></tr>"; // errore mezua erakutsiko du 4 zutabeak elkartuz
            } // kondizioa betetzen ez den exekutatuko den kodea amaitzen da
            ?> <!-- php etiketa itxi du -->
        </tbody> <!-- taularen body etiketa itxi du -->
    </table> <!-- taula amaitzen du -->
</body> <!-- dokumentuaren gorputzaren etiketa itxi du -->

</html> <!-- html etiketa itxi du eta amaitzen da web orria -->