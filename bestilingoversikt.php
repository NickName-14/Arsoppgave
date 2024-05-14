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
    <title>Bestilinger-Digistore</title>
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
<div>
    <h1>Dine Bestilinger</h1>
</div>
</body>
</html>
<?php
$sql_bestiling = "SELECT ProduktiBestilingId, Kunde, Dato/*, Status*/ FROM Bestilinger WHERE Kunde = '" . $_SESSION['id'] . "' ";

$result_bestiling = $link->query($sql_bestiling);


if ($result_bestiling->num_rows > 0) { 
    echo "<table class='ticket-info-table'>";
    echo "<tr><th>Bestilings nummer</th><th>Mottaker</th><th>Status</th><th>Dato</th>";
    while ($row = $result_bestiling->fetch_assoc()) {
        echo "<tr>";
        echo "<td><a href='set_bestiling_oversikt.php?produktid=" . $row["ProduktiBestilingId"] . "'>" . $row["ProduktiBestilingId"] . "</a></td>";

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
    echo "Ingen bestilinger.";
}

?>