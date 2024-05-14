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
    <a href="adminoversikt.php" class="Menyknapp">Bestilings Oversikt</a>
    <a href="nyfaq.php" id="Menyaktiv">Ny faq side</a>
    <a href="nyttprodukt" class="Menyknapp" >Legge Til Produkt</a>
</ul>

<h1>Legge til nytt produkt</h1>
<form method="post" action="AddFAQ.php" enctype="multipart/form-data">

    <label for="navn">Produkt navn:</label>
    <input type="text" id="navn" name="navn"><br><br>
    
    <label for="pris">Produkt pris:</label>
    <input type="text" id="pris" name="pris"><br><br>
    
    <label for="merke">Produkt merke:</label>
    <input type="text" id="merke" name="merke"><br><br>

    <input type="submit" value="Submit">
</form>
</body>
</html>
