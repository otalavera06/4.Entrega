<!DOCTYPE html> <!-- fitxategia html bat izango da -->
<html lang="eu"> <!-- dokumentuaren hizkuntza definitzen du -->

<head> <!-- head etiketa irekutzen du -->
    <meta charset="UTF-8"> <!-- UTF-8 kodifikazioa erabiliko du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Pantailaren neurriak zein izango diren definitu ditu -->
    <title>Produktu Berria</title> <!-- Izenburua jarri dio web orriaren hasiera-leiatilan agertuko dena -->
    <link rel="stylesheet" href="../ariketak.css">
    <!-- Css dei bat egiten dio ariketak izeneko fitxategian definituriko estiloa eduki dezan -->

</head> <!-- head etiketa itxi du -->

<body> <!-- Body etiketa ireki du -->
    <?php // PHP etiketa ireki du
    
    require_once("../db.php"); // Refaktorizatuta konexioa egiten du gure datu basera
    
    // gure formularioa egongo diren datuak definitzen ditu
    if (isset($_POST['izena'])) { // Izena dagoen ala ez egiaztatzen duen kondizioa sortu du
        $izena = $_POST['izena']; // Aldagaian balorea gordetzen du
    } else { // Kondizioa ez bada betetzen, exekutatuko den kodea
        $izena = ''; // Ez badu kondiziorik betetzen, aldagaia hutsik egongo da
    } // kondizioa ez bada betetzen, exekutatuko den kodea amaitzen da
    
    if (isset($_POST['mota'])) { // Mota dagoen ala ez egiaztatzen duen kondizioa sortu du
        $mota = $_POST['mota']; // Aldagaian balorea gordetzen du
    } else { // Kondizioa ez bada betetzen, exekutatuko den kodea
        $mota = ''; // Ez badu kondiziorik betetzen, aldagaia hutsik egongo da
    } // kondizioa ez bada betetzen, exekutatuko den kodea amaitzen da
    
    if (isset($_POST['prezioa'])) { // Prezioa dagoen ala ez egiaztatzen duen kondizioa sortu du
        $prezioa = $_POST['prezioa']; // Aldagaian balorea gordetzen du
    } else { // Kondizioa ez bada betetzen, exekutatuko den kodea
        $prezioa = ''; // Ez badu kondiziorik betetzen, aldagaia hutsik egongo da
    } // kondizioa ez bada betetzen, exekutatuko den kodea amaitzen da
    
    if ($izena && $mota && $prezioa) { // Sortutako aldagaiek balorerik badute (ez badira nuloak) kondizioa sortzen du

        $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')"; // SQL kontsulta sortu du insert-a egiteko


        if ($conn->query($sql) === TRUE) { // SQL kontsulta ongi egin den egiaztatzen duen kondizioa
            header("Location: 2ariketa.php"); // Ongi egin badu, aurreko lehiora bueltatuko da
            exit(); // amaitu egiten du orain gauden PHP fitxategia
        } else { // Kondizioa ez bada betetzen, exekutatuko den kodea
            echo "Errorea gertatu da produktu berria gehitzen: " . $conn->error; // errore mezua erakutsiko du
        } // kondizioa ez bada betetzen, exekutatuko den kodea amaitzen da
    } // Kondizio nagusia amaitzen da

    ?> <!-- PHP etiketa itxi du -->
    <h1>Produktu Berria Gehitu</h1> <!-- h1 etiketa ireki du izenburu bat ezartzeko web orria zertarako den jakiteko -->
    <form method="POST"> <!-- Formulario bat ireki du post metodoa erabiliz -->
        <label for="izena">Izena:</label> <!-- Label bat sortu du izenarekin lotuta dagoena -->
        <input type="text" id="izena" name="izena" required>
        <!-- Input bat sortu du testu motakoa eta derrigorrezkoa dena -->
        <br> <!-- ilaraz salto egin du -->
        <label for="mota">Mota:</label> <!-- Label bat sortu du motarekin lotuta dagoena -->
        <select id="mota" name="mota" required>
            <!-- Barra desplegable bat sortu du mota ezberdinak erakutsiko dituena -->
            <option value="Portatil">Portatil</option> <!-- Aukera bat portatil balioa izango duena -->
            <option value="Kontsola">Kontsola</option> <!-- Aukera bat kontsola balioa izango duena -->
            <option value="Periferiko">Periferiko</option> <!-- Aukera bat periferiko balioa izango duena -->
            <option value="Cascos">Cascos</option> <!-- Aukera bat kaskoen balioa izango duena -->
        </select> <!-- Aukera zerrenda itxi du -->
        <br> <!-- ilaraz salto egin du -->
        <label for="prezioa">Prezioa:</label> <!-- Label bat sortu du prezioarekin lotuta dagoena -->
        <input type="number" step="any" id="prezioa" name="prezioa" required>
        <!-- Input bat sortu du zenbaki motakoa eta derrigorrezkoa dena -->
        <br> <!-- ilaraz salto egin du -->
        <input type="submit" value="Gehitu"> <!-- Botoia sortu du formarioa bidaltzeko -->
    </form> <!-- Formularioa itxi du -->
</body> <!-- Body etiketa itxi du -->

</html> <!-- Html etiketa itxi du -->