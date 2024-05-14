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
    <div class="Meny">
    
    <ul class="TopNav">
    <a href="index.php" class="Menyknapp"><h3>Hjem</h3></a>
    <a href="admin.php" id="Menyaktiv"><h3>Admin</a>
    <a href="Produktoversikt.php" class="Menyknapp">Produkter</a>
    <a href="FAQ.php"class="Menyknapp">FAQ</h3></a>
   </ul>
 </div>

 <ul class="TopNav">
    <a href="adminoversikt.php" id="Menyaktiv">Bestilings Oversikt</a>
    <a href="nyfaq.php" class="Menyknapp">Ny faq side</a>
    <a href="nyttprodukt.php" class="Menyknapp">Legge Til Produkt</a>
</ul>
</body>
</html>
<?php
$sql_bestiling = "SELECT ProduktiBestilingId, Kunde, Dato, Status FROM Bestilinger";

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

        
        echo "<td>" . $row["Status"] . "</td>";
        echo "<td>" . $row["Dato"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Ingen bestilinger.";
}
?>