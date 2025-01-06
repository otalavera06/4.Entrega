<!DOCTYPE html>
<html lang="eu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktu Zerrenda</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="1ariketa.css">
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "1MG2024";
    $dbname = "ml";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Errorea konektatzean: " . $conn->connect_error);
    }

  
    if (isset($_GET['ezabatu'])) {
        $izena = $_GET['ezabatu'];

        
        $sql = "DELETE FROM produktuak WHERE izena = '$izena'";

        if ($conn->query($sql) === TRUE) {
            echo "Produktu ezabatua!";
        } else {
            echo "Errorea produktu bat ezabatzean: " . $conn->error;
        }
    }

    $mota= '';
    $bilaketa = '';
    if (isset($_GET['bilaketa'])) {
        $bilaketa = $_GET['bilaketa'];
    }
    if (isset($_GET['mota'])) {
        $mota = $_GET['mota'];
    }

    if ($bilaketa != '') {
        $sql = "SELECT izena, mota, prezioa FROM produktuak WHERE izena LIKE '%$bilaketa%'";
    } elseif ($mota != '') {
        $sql = "SELECT izena, mota, prezioa FROM produktuak WHERE mota = '$mota'";
    } else {
        $sql = "SELECT izena, mota, prezioa FROM produktuak";
    }

    $result = $conn->query($sql);
    ?>

    <h1>Produktu Zerrenda</h1>
    <form action="1ariketa.php" method="GET">
        <a href="form.php">
            <i class="fa fa-plus" aria-hidden="true" title="Produktu Berria Gehitu"></i>
        </a>
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
    </form>

    <table>
        <thead>
            <tr>
                <th>Izena</th>
                <th>Mota</th>
                <th>Prezioa</th>
                <th>Ekintzak</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['izena'] . "</td>";
                    echo "<td>" . $row['mota'] . "</td>";
                    echo "<td>" . $row['prezioa'] . "</td>";
                    echo "<td>
                            <a href='editatu.php'>
                                <i class='fas fa-pencil' title='Editatu'></i>
                            </a>
                            <a href='1ariketa.php?ezabatu=" . urlencode($row['izena']) . "' onclick=\"return confirm('Ziur zaude ezabatu nahi duzula?');\">
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
