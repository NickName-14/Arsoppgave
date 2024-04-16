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
    <h1><?php echo ($_SESSION["navn"]); ?></h1>
</body>
</html>
<?php

?>