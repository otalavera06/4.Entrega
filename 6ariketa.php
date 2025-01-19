<!DOCTYPE html> <!-- fitxategia html bat izango da -->
<html lang="eu"> <!-- dokumentuaren hizkuntza definitzen du -->

<head> <!-- head etiketa irekutzen du -->
    <meta charset="UTF-8"> <!-- UTF-8 kodifikazioa erabiliko du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Pantailaren neurriak zein izango diren definitu ditu -->
    <title>Editatu Produktua</title>
    <link rel="stylesheet" href="../ariketak.css">
    <!-- Css dei bat egiten dio ariketak izeneko fitxategian definituriko estiloa eduki dezan -->
</head> <!-- head etiketa itxi du -->

<body> <!-- Body etiketa irekiten du -->
    <?php // PHP etiketa irekiten du
    require_once("db.php"); // Refaktorizatuta konexioa egiten du gure datu basearekin
    
    $idProduktua = ""; // Aldagai hutsa sortu du "idProduktua" izenarekin
    $izena = ""; // Aldagai hutsa sortu du "izena" izenarekin
    $mota = ""; // Aldagai hutsa sortu du "mota" izenarekin
    $prezioa = ""; // Aldagai hutsa sortu du "prezioa" izenarekin
    
    if (isset($_GET["id"]) && !empty($_GET["id"])) { // id duen ala ez egiaztatzen duen kondizioa sortu du
        $idProduktua = ($_GET["id"]); // Kondizioa betetzen bada aldagaiean balio berria gordeko du
    } // Kondizioa amaitzen da
    
    $bistaratu = "SELECT id, izena, mota, prezioa FROM produktuak WHERE id = '$idProduktua'"; // kontsulta bat egiten du produktuen datuak jasotzeko
    $result = $conn->query($bistaratu); // Kontsulta exekutatzen du
    
    if ($result->num_rows > 0) { // Kontsulta ongi joan dela konprobatzen du
        $row = $result->fetch_assoc(); // Kontsultaren emaitza row izeneko array batean gordetzen du
        $izena = $row["izena"]; // Arrayaren izena posizioko balorea izena aldagaiean gordetzen du
        $mota = $row["mota"]; // Arrayaren mota posizioko balorea mota aldagaiean gordetzen du
        $prezioa = $row["prezioa"]; // Arrayaren prezioa posizioko balorea prezioa aldagaiean gordetzen du
    } // Kondizioa betetzen denerako kodea amaitzen du

    ?> <!-- Php etiketa itxi du -->
    <!-- Hasieran erabiltzaileak id-a aldatzeko aukera zuen, ezin izan beharko zuen erabiltzaileak gure produktuaren id-a aldatu -->
    <form method="post"> <!-- Formulario bat sortu du datuak editatzeko balioko duena post metodoa erabiliz -->
        <br> <!-- ilara salto bat egin du -->
        <label for="izena"><strong>Erregistroa sartu: </strong></label>
        <!-- Label bat sortu du izenaren erlazionatuta dagoena -->
        <br> <!-- ilara salto bat egin du -->
        <input type="text" name="izena" id="izena" value="<?php echo $izena ?>" placeholder="sartu izena" />
        <!-- Izenarentzat input bat sortu du, value erabiliz lehengo izena aterako zaio defektuz eta aldatzeko aukera izango du erabiltzaileak -->
        <select id="mota" name="mota" required>
            <!-- Selekt bat sortu du motaren ezberdin guztiak izango dituen desplegablea izateko -->
            <!-- motaren balio bakoitzerako konprobazio bat sortu da defektuz aukeratuta egon dedin produktuak zuen mota -->
            <option value="Portatil" <?php if ($mota == 'Portatil')
                echo 'selected'; ?>>Portatil</option>
            <option value="Kontsola" <?php if ($mota == 'Kontsola')
                echo 'selected'; ?>>Kontsola</option>
            <option value="Periferiko" <?php if ($mota == 'Periferiko')
                echo 'selected'; ?>>Periferiko</option>
            <option value="Cascos" <?php if ($mota == 'Cascos')
                echo 'selected'; ?>>Cascos</option>
        </select> <!-- Desplegablea itxi du -->
        <input type="number" name="prezioa" step="any" id="prezioa" value="<?php echo $prezioa ?>" placeholder="..€">
        <!-- Input bat sortu du prezioarentzat zenbaki motako eta defektuz produktuaren balioa erakutsiko diona -->
        <button name="editatubotoia">Sartu</button> <!-- Botoia sortu du formularioa bidaltzeko -->
    </form> <!-- Formularioa itxi du -->

    <?php // Php etiketa ireki du
    if (isset($_POST['editatubotoia'])) { // Botoiari sakatu dion kondizioa sortzen du
        $izena = $_POST['izena']; // izena aldagaiari balio berria eman dio
        $mota = $_POST['mota']; // mota aldagaiari balio berria eman dio
        $prezioa = $_POST['prezioa']; // prezioa aldagaiari balio berria eman dio
    
        $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE id='$idProduktua'"; // Kontsulta bat egiten du sartu dituen aldagai berriekin taula eguneratu dezan
    
        if ($conn->query($sql) === TRUE) { // SQL kontsulta ongi egin den egiaztatzen duen kondizioa
            header("Location: 1ariketa.php"); // Ongi egin badu, aurreko lehiora bueltatuko da
            exit(); // amaitu egiten du orain gauden PHP fitxategia
        } else { // Ez bada kondizioa betetzen, exekutatuko den kodea
            echo "Arazoak taula eguneratzean: " . $conn->error; // Errore mezuaa erakusten du
        } // Kondizioa betetzen ez denean, exekutatuko den kodea amaitzen da
    } // Kondizio nagusia amaitzen da
    
    $conn->close(); // datu basearekin konexioa itxi du
    ?> <!-- php etiketa itxi du -->
</body> <!-- Dokumentuaren gorputzaren etiketa itxi du -->

</html> <!-- HTML etiketa itxi du eta amaitzen da web orria -->