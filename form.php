<!DOCTYPE html> <!-- Dokumentu mota HTML dela adierazten du -->
<html lang="eu"> <!-- HTML ireki eta euskara dokumentuaren hizkuntza gisa ezartzen du -->

<head> <!-- Head ireki -->
    <meta charset="UTF-8"> <!-- Kodifikazioa UTF-8 dela definitzen du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Mugikorretarako optimizatzeko -->
    <title>Produktu Berria</title> <!-- CSS estilo fitxategiarekin konexioa -->
</head> <!-- Head itxi -->

<body><!-- Body ireki -->
    <?php //php erabiltzeko etiketa
    
    $servername = "localhost"; //Datu baseko zerbitzaria aldagai batean gorde
    $username = "root"; //Datu baseko erabiltzailea aldagai batean gorde
    $password = "1MG2024"; //Datu baseko pasahitza aldagai batean gorde
    $dbname = "ml"; //Datu baseko eskema izena aldagai batean gorde
    
    if (isset($_POST['izena'])) { //Post array-an izena parametroak balioa duen ala ez egiaztatu
        $izena = $_POST['izena']; //Hala bada aldagai bean gorde
    } else { //Bestela
        $izena = ''; //Hust bezala hasieratu
    }

    if (isset($_POST['mota'])) { //Post array-an mota parametroak balioa duen ala ez egiaztatu
        $mota = $_POST['mota']; //Hala bada aldagai bean gorde
    } else { //Bestela
        $mota = ''; //Hust bezala hasieratu
    }

    if (isset($_POST['prezioa'])) { //Post array-an prezioa parametroak balioa duen ala ez egiaztatu
        $prezioa = $_POST['prezioa']; //Hala bada aldagai bean gorde
    } else { //Bestela
        $prezioa = ''; //Hust bezala hasieratu
    }


    $conn = new mysqli($servername, $username, $password, $dbname); //Datu basearekin konexioa egin emandako datuak erabiliz
    
    if ($conn->connect_error) {
        die("Errorea konektatzean: " . $conn->connect_error); //Konexio errore bat gertatzen bada mezua erakutxi eta exekuzioa gelditu
    } else { //Bestela
        echo "Konektatuta zaude<br>"; //Konexio arrakasta mezua
    }

    if ($izena && $mota && $prezioa) { //Kanpo guztiak beteta badaude
    
        $sql = "INSERT INTO produktuak (izena, mota, prezioa) VALUES ('$izena', '$mota', '$prezioa')"; //SQL insert kontsulta egin sartutako datuekin
    

        if ($conn->query($sql) === TRUE) { //Kontsultak funtzionatu duen egiaztatu
            echo "Produktu berria gehitu da!";  //Hala bada arrakasta mezua
        } else { //Bestela 
            echo "Errorea gertatu da produktu berria gehitzen: " . $conn->error; //Errore mezua
        }
    }

    ?> <!-- PHP itxi -->
    <h1>Produktu Berria Gehitu</h1> <!-- Titulu bat -->
    <form method="POST"> <!-- Formulario bat ireki, post metodoarekin -->
        <label for="izena">Izena:</label> <!-- Izena input-arentzat textua -->
        <input type="text" id="izena" name="izena" required>
        <!-- Izena datuarentzat textu kutxa, beharrezkoa da betetzea -->
        <br>
        <label for="mota">Mota:</label> <!-- Mota datuarentzat textua -->
        <select id="mota" name="mota" required> <!-- Mota datuarentzat select bat, beharrezkoa da betetzea -->
            <option value="Portatil">Portatil</option> <!-- Aukera bat -->
            <option value="Kontsola">Kontsola</option><!-- Aukera bat -->
            <option value="Periferiko">Periferiko</option> <!-- Aukera bat -->
            <option value="Cascos">Cascos</option> <!-- Aukera bat -->
        </select>
        <br>
        <label for="prezioa">Prezioa:</label> <!--Prezioa input-arentzat textua  -->
        <input type="number" id="prezioa" name="prezioa" required>
        <!-- Prezioa datuarentzat zenbaki kutxa, beharrezkoa da betetzea -->
        <br>
        <input type="submit" value="Gehitu"> <!-- Formularioa bidaltzeko botoia -->
    </form> <!-- formularioa itxi -->
    <a href="1ariketa.php"><button>Bueltatu horrira</button></a> <!-- 1ariketa.php fitxategira joateko botoi bat -->
</body> <!-- Body itxi -->

</html> <!-- HTML itxi -->