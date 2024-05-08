<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
} elseif (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== "True"){
    header("location: index.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Digistore</title>
    <link rel="icon" type="image/x-icon" href="Bilder/Logo/IconAarsoppgave.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="Menybilde">
    <img src="Bilder/Logo/LogoAarsoppgave.png" alt="" width="15%">
    </div>
    
<?php

$sql_bestiling = "SELECT ProduktiBestilingId, Kunde, Dato/*, Status*/ FROM Bestilinger";

$result_bestiling = $link->query($sql_bestiling);


if ($result_bestiling->num_rows > 0) { 
    echo "<table class='ticket-info-table'>";
    echo "<tr><th>Bestilings nummer</th><th>Mottaker</th><th>Status</th><th>Dato</th>";
    while ($row = $result_bestiling->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='set_admin_oversikt.php?produktid=" . $row["ProduktiBestilingId"] . "'>" . $row["ProduktiBestilingId"] . "</a></td>";

        $sql_kunde = "SELECT navn FROM Kunder WHERE Kunderid = '" . $row['Kunde'] . "' ";
        $result_kunde = $link->query($sql_kunde);
        if ($result_kunde->num_rows > 0) { 

            while ($row_kunde = $result_kunde->fetch_assoc()) {
                echo "<td>" . $row_kunde["navn"] . "</td>";
            }
        } 

        
        //echo "<td>" . $row["Status"] . "</td>";
        echo "<td>" . $row["Dato"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No ticket found.";
}

?>
<h1>Legge til nytt produkt</h1>
<form method="post" action="uploadfile.php" enctype="multipart/form-data">

    <label for="navn">Produkt navn:</label>
    <input type="text" id="navn" name="navn"><br><br>
    
    <label for="pris">Produkt pris:</label>
    <input type="text" id="pris" name="pris"><br><br>
    
    <label for="merke">Produkt merke:</label>
    <input type="text" id="merke" name="merke"><br><br>
    
    <label for="kategori">Produkt kategori:</label>
    <input type="text" id="kategori" name="kategori"><br><br>
    
    <label for="info">Produkt info:</label>
    <input type="text" id="info" name="info"><br><br>

    <label for="file">ProduktBilde:</label>
   <input type="file" name="uploadfile" />
    
    <input type="submit" value="Submit">
</form>


</body>
</html>