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
<div class="Ikoner">
        <a href="handlevogn.php"><img src="Bilder/SVG/conversation-svgrepo-com.svg" height="50px" alt=""></a>
        <div class="Meny">
    
        <ul class="TopNav">
        <a href="index.php" class="Menyknapp"><h3>Hjem</a>
        <a href="Produktoversikt.php" id="Menyaktvi">Produkter</a>
        <a href="FAQ.php"class="Menyknapp">FAQ</h3></a>
       </ul>
     </div>
        <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg"  height="50px" alt=""></a>
    </div>
</body>
</html>
<?php

?>