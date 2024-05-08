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
<h1>Legge til flere produkter</h1>
<form method="post" action="upload.php">
    <label for="input1">Input 1:</label>
    <input type="text" id="input1" name="input1"><br><br>
    
    <label for="input2">Input 2:</label>
    <input type="text" id="input2" name="input2"><br><br>
    
    <label for="input3">Input 3:</label>
    <input type="text" id="input3" name="input3"><br><br>
    
    <label for="input4">Input 4:</label>
    <input type="text" id="input4" name="input4"><br><br>
    
    <label for="input5">Input 5:</label>
    <input type="text" id="input5" name="input5"><br><br>

    <label for="image">Upload Image:</label>
    <input type="file" id="image" name="image"><br><br>
    
    <input type="submit" value="Submit">
</form>


</body>
</html>