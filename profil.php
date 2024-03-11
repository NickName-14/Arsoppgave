<?php
session_start();
require_once "config.php";
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
<div class="Meny">
        <ul class="TopNav">
        <a href="index.php" class="Menyknapp"><h3>Hjem</a>
        <a href="Produktoversikt.php" class="Menyknapp">Produkter</a>
        <a href="profil.php" id="Menyaktiv">Profil</a>
        <a href="FAQ.php"class="Menyknapp">FAQ</h3></a>
    </ul>
</div>
</body>
</html>
<?php

?>