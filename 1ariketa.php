<!DOCTYPE html> <!-- Dokumentu mota HTML dela adierazten du -->
<html lang="eu"> <!-- HTML ireki eta euskara dokumentuaren hizkuntza gisa ezartzen du -->

<head> <!-- Head ireki -->
    <meta charset="UTF-8"> <!-- Kodifikazioa UTF-8 dela definitzen du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mugikorretarako optimizatzeko -->
    <title>Produktu Zerrenda</title> <!-- Orriaren titulua nabigatzaileko leihoan -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Ikonoak gehitzeko -->
    <link rel="stylesheet" href="1ariketa.css"> <!-- CSS estilo fitxategiarekin konexioa -->
</head> <!-- Head itxi -->

<body> <!-- Body ireki -->
    <?php //php erabiltzeko etiketa
    $servername = "localhost"; //Datu baseko zerbitzaria aldagai batean gorde
    $username = "root"; //Datu baseko erabiltzailea aldagai batean gorde
    $password = "1MG2024"; //Datu baseko pasahitza aldagai batean gorde
    $dbname = "ml"; //Datu baseko eskema izena aldagai batean gorde
    
    $conn = new mysqli($servername, $username, $password, $dbname); //Datu basearekin konexioa egin emandako datuak erabiliz
    
    if ($conn->connect_error) {
        die("Errorea konektatzean: " . $conn->connect_error); //Konexio errore bat gertatzen bada mezua erakutxi eta exekuzioa gelditu
    }


    if (isset($_GET['ezabatu'])) { //Get array-an ezabatu parametroak balioa duen ala ez egiaztatu
        $izena = $_GET['ezabatu']; //Hala bada aldagai bean gorde
    

        $sql = "DELETE FROM produktuak WHERE izena = '$izena'"; //SQL kontsulta egin emandako izenarekin
    
        if ($conn->query($sql) === TRUE) { //Kontsultak funtzionatu duen egiaztatu
            echo "Produktu ezabatua!"; //Hala bada arrakasta mezua
        } else { //Bestela
            echo "Errorea produktu bat ezabatzean: " . $conn->error; //Errore mezua
        }
    }

    $mota = ''; //Mota huts bezala hasieratu
    $bilaketa = ''; //Bilaketa huts bezala hasieratu
    if (isset($_GET['bilaketa'])) { //Get array-an bilaketa parametroak balioa duen ala ez egiaztatu
        $bilaketa = $_GET['bilaketa']; //Hala bada aldagai bean gorde
    }
    if (isset($_GET['mota'])) { //Get array-an mota parametroak balioa duen ala ez egiaztatu
        $mota = $_GET['mota'];//Hala bada aldagai bean gorde
    }

    if ($bilaketa != '') { //Bilaketa hutsa ez bada
        $sql = "SELECT izena, mota, prezioa FROM produktuak WHERE izena LIKE '%$bilaketa%'"; //SQL kontsulta egin sartutako izena erabiliz
    } elseif ($mota != '') { //Bestela, mota hutsa ez bada
        $sql = "SELECT izena, mota, prezioa FROM produktuak WHERE mota = '$mota'";//SQL kontsulta egin sartutako mota erabiliz
    } else {//Bestela
        $sql = "SELECT izena, mota, prezioa FROM produktuak";//Taula osoa erakutsi filtrorik gabe
    }

    $result = $conn->query($sql); //Kontsulta aldagai batean gorde
    ?> <!-- PHP itxi -->

    <h1>Produktu Zerrenda</h1> <!-- Titulu bat -->
    <form action="1ariketa.php" method="GET"> <!-- Formularioa ireki -->
        <a href="form.php"> <!-- form.php fitxategira eramaten duen esteka -->
            <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i><!-- Plus ikonoa gehitu -->
        </a>
        <label for="bilaketa">Bilatu:</label><!-- Bilatu input-erako testua -->
        <input type="text" class="bilaketa" name="bilaketa" id="bilaketa" value="<?php echo $bilaketa; ?>">
        <!-- Bilaketa egiteko textu kutxa, defektuz lehengoko bilaketa agertzen da -->
        <input type="submit" value="Filtratu"> <!-- Formularioa bidaltzeko botoia -->
        <select id="mota" name="mota"> <!-- Mota aukeratzeko select bat -->
            <option></option> <!-- Aukera hutsa defektuz ezer ez agertzeko -->
            <option value="Portatil">Portatil</option> <!-- Aukera bat, Portatila -->
            <option value="Kontsola">Kontsola</option> <!-- Aukera bat, kontsola -->
            <option value="Periferiko">Periferiko</option> <!-- Aukera bat, periferikoa -->
            <option value="Cascos">Cascos</option> <!-- Aukera bat, kaskoak -->
        </select> <!-- Select itxi -->
    </form> <!-- Formularioa itxi -->

    <table><!-- Taula ireki -->
        <thead> <!-- Taularen "Burua" -->
            <tr> <!-- Taulako lerro bat -->
                <th>Izena</th> <!-- Zutabe baten izena -->
                <th>Mota</th> <!-- Zutabe baten izena -->
                <th>Prezioa</th> <!-- Zutabe baten izena -->
                <th>Ekintzak</th> <!-- Zutabe baten izena -->
            </tr>
        </thead>
        <tbody><!-- Taularen "Gorputza" -->
            <?php //PHP ireki
            if ($result->num_rows > 0) { //Kontsultaren lerro kopurua zero baino gehiago bada
                while ($row = $result->fetch_assoc()) { //Lerro bakoitzeko errepikatu
                    echo "<tr>"; //Taula lerro berri bat
                    echo "<td>" . $row['izena'] . "</td>"; //Izena zutabeko datua
                    echo "<td>" . $row['mota'] . "</td>";// mota zutabeko datua
                    echo "<td>" . $row['prezioa'] . "</td>"; //Prezioa zutabeko datua
                    echo "<td> " ./*Ekintzak zutabeko gelaxka*/ "
                            <a href='editatu.php'> " ./*editatu,php fitxategira esteka*/ "
                                <i class='fas fa-pencil' title='Editatu'></i> " ./*Arkatz ikonoa gehitu*/ "
                            </a>
                            <a href='1ariketa.php?ezabatu=" . urlencode($row['izena']) . "' onclick=\"return confirm('Ziur zaude ezabatu nahi duzula?');\"> " ./*1ariketa.php fitxategira esteka. lerro horretako izena gelaxkan dagoen datua eramaten du ezabatzeko  eta klikatzean mezu bat bistaratzen du ea benetan ezabatu nahi duzun galdetzeko*/ "
                                <i class='fas fa-trash' title='Ezabatu'></i> " ./*Zakarrontzi ikonoa gehitu*/ "
                            </a>
                          </td>";
                    echo "</tr>"; //Lerroa itxi
                }
            } else { //Bestela
                echo "<tr><td colspan='4'>Ez da produktu bat aurkitu.</td></tr>"; //Ez dela daturik aurkitu adierazi erabiltzaileari
            }
            ?><!-- PHP itxi -->
        </tbody>
    </table> <!-- Taula itxi -->
</body> <!-- Body itxi -->

</html> <!-- HTML itxi -->