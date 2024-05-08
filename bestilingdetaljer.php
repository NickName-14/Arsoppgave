<?php 
session_start();
require_once "config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil-Digistore</title>
    <link rel="icon" type="image/x-icon" href="Bilder/Logo/IconAarsoppgave.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="Menybilde">
    <img src="Bilder/Logo/LogoAarsoppgave.png" alt="" width="15%">
    </div>
<div class="Ikoner">
        <a href="handlevogn.php"><img src="Bilder/SVG/conversation-svgrepo-com.svg" height="50px" alt=""></a>
        <div class="Meny">
    
        <ul class="TopNav">
        <h3><a href="index.php"class="Menyknapp">Hjem</a></h3>
        <h3><a href="Produktoversikt.php" class="Menyknapp">Produkter</a></h3>
        <h3><a href="FAQ.php"class="Menyknapp">FAQ</a></h3>
        <h3><a href="Logut.php"class="Menyknapp">Log ut</a></h3>
     </ul>
     </div>
        <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg" id="profil" height="50px" alt=""></a>
    </div>
</body>
</html>
<?php
 
 $sql = "SELECT Produkt_handlevognid, Antall FROM Handlevogn WHERE Kunde_handlevognid = '" . $_SESSION['id'] . "'";

$result_outer = $link->query($sql);

if ($result_outer->num_rows > 0) {
    while ($row_outer = $result_outer->fetch_assoc()) {
        $produkt_handlevognid = $row_outer['Produkt_handlevognid'];

        $sql_inner = "SELECT Produktid, ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde FROM Produkter WHERE Produktid = '" . $produkt_handlevognid . "'";
        $result_inner = $link->query($sql_inner);

        if ($result_inner->num_rows > 0) {
            while ($row_inner = $result_inner->fetch_assoc()) {
                echo "<div class='HandlevognElement'>";
                echo "<img src='" . $row_inner["ProduktBilde"] . "' height='100px'>";
                echo "<div>";
                echo "<h2>".$row_inner['ProduktNavn']."</h2>";
                echo "<h3>".$row_inner['ProduktKategori']."</h3>";
                echo "</div>";
                echo "<h2>". $row_inner["ProduktPris"] .",-</h2>";
                echo "</div>";
            }
        } else {
            echo "<tr><td colspan='3'>Du har ingen produkter i bestilingen</td></tr>";
        }
    }
} else {
    echo "<tr><td colspan='3'>Du har ingen produkter i bestilingen</td></tr>";
}
?>