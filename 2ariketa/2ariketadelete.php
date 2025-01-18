<?php 

    require_once("../db.php");

$id = "";

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = $_GET["id"];
}


$sql = "DELETE FROM produktuak WHERE id='$id';";

if ($conn->query($sql) === TRUE) {
    header("Location: 2ariketa.php");
} else {
    echo "Arazoa erregistroa ezabatzean: " . $conn->error;
}

$conn->close();

?>