<!DOCTYPE html> <!-- Dokumentu mota HTML dela adierazten du -->
<html lang="eu"> <!-- HTML ireki eta euskara dokumentuaren hizkuntza gisa ezartzen du -->

<head> <!-- Head ireki -->
    <meta charset="UTF-8"> <!-- Kodifikazioa UTF-8 dela definitzen du -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Mugikorretarako optimizatzeko -->
    <title>Editatu Produktua</title> <!-- Orriaren titulua nabigatzaileko leihoan -->
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

    $row = ""; //row huts bezala hasieratu
$idProduktua=""; //id-a huts bezala hasieratu
$izena = ""; //izena huts bezala hasieratu
$mota = ""; //Mota huts bezala hasieratu
$prezioa = ""; //Prezioa huts bezala hasieratu
if (isset($_GET["izena"])) { //Get array-an izena parametroak balioa duen ala ez egiaztatu
    $izena = ($_GET["izena"]); //Hala bada aldagai bean gorde
}
if (isset($_GET["idProduktua"])) {  //Get array-an idProduktua parametroak balioa duen ala ez egiaztatu
    $idProduktua = ($_GET["idProduktua"]);//Hala bada aldagai bean gorde
}
if (isset($_GET["mota"])) {  //Get array-an mota parametroak balioa duen ala ez egiaztatu
    $mota = ($_GET["mota"]);//Hala bada aldagai bean gorde
}
if (isset($_GET["prezioa"])) {  //Get array-an prezioa parametroak balioa duen ala ez egiaztatu
    $prezioa = ($_GET["prezioa"]);//Hala bada aldagai bean gorde
}
?><!-- PHP itxi -->
 
<form  method="get"> <!-- Formularioa ireki, get metodoarekin -->
    <br>
    <label for="izena"> <strong>Erregistroa sartu: </strong></label> <!-- Izena input-aretntzat textua -->
    <br>
    <input type="text" name="idProduktua" id="idProduktua" value="" placeholder="sartu id-a" /> <!-- ID-a sartzeko textu kutxa, placeholder gisa mezu bat -->
    <input type="text" name="izena" id="izena" value="" placeholder="sartu izena" /> <!-- Izena sartzeko textu kutxa -->
    <select id="mota" name="mota" required> <!-- Mota aukeratzeko select bat -->
            <option value="Portatil">Portatil</option> <!-- Aukera bat -->
            <option value="Kontsola">Kontsola</option> <!-- Aukera bat -->
            <option value="Periferiko">Periferiko</option> <!-- Aukera bat -->
            <option value="Cascos">Cascos</option> <!-- Aukera bat -->
        </select>
    <input type="number" name="prezioa" id="prezioa" value="" placeholder="..€"> <!-- Prezioa sartzeko zenbaki kutxa -->
    <button>Sartu</button> <!-- Formularioa bidaltzeko botoia -->
</form> <!-- Formularioa itxi -->
<a href="1ariketa.php"><button>Bueltatu horrira</button></a> <!-- 1ariketa.php fitxategira joateko botoi bat -->
 

 
 <?php //PHP rireki 
 $sql = "UPDATE produktuak SET izena='$izena', mota='$mota', prezioa='$prezioa' WHERE idProduktua='$idProduktua'"; //SQL update kontsulta bat egin sartutako datuak erabiliz zeudenak aldatuz
 
 if ($conn->query($sql) === TRUE) { //Kontsultak funtzionatu duen egiaztatu
     echo "Record updated successfully"; //Hala bada arrakasta mezua
 } else {//Bestela 
     echo "Error updating record: " . $conn->error; //Errore mezua
 }

 $conn->close(); //Konexioa itxi
?> <!-- PHP itxi -->