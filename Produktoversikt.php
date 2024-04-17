<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produkter-Digistore</title>
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
        <a href="index.php" class="Menyknapp"><h3>Hjem</a>
        <a href="Produktoversikt.php" id="Menyaktiv">Produkter</a>
        <a href="FAQ.php"class="Menyknapp">FAQ</h3></a>
       </ul>
     </div>
        <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg"  height="50px" alt=""></a>
</div>
    <div class="ProduktOversikt">
    <?php

 $sql = "SELECT Produktid, ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde FROM Produkter";


 $result = $link->query($sql);


 if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

    echo "<div class='ProduktPreview'>";
    echo "<img src='" . $row["ProduktBilde"] . "'class='ProduktBilde' height='300px'>";
    echo "<p>". $row["ProduktKategori"] ."</p>";
    echo "<h2>". $row["ProduktNavn"] ."</h2>";
    echo "<h3>". $row["ProduktPris"] .",-</h3>";
    echo "<div class='Detaljerknapp'><a class='knapptekst'href='set_produkt.php?produktid=" . $row["Produktid"] . "'>Se Detaljer</a></div>";
    echo "<div class='Handlevognknapp'><a class='knapptekst'href='set_produkt_handlevogn.php?produktid=" . $row["Produktid"] . "'>Legg I Handlevogn</a></div>";

    echo "</div>";
    }
 } else {
    echo "<tr><td colspan='3'>No records found</td></tr>";
 }
?>
    </div>
</body>
</html>
