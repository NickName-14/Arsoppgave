<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ-Digistore</title>
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
        <a href="Produktoversikt.php"class="Menyknapp" >Produkter</a>
        <a href="FAQ.php"id="Menyaktiv">FAQ</h3></a>
       </ul>
     </div>
        <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg"  height="50px" alt=""></a>
</div>

<?php

$sql = "SELECT Navn, Kategori, FAQtekst FROM FAQ";


$result = $link->query($sql);


if ($result->num_rows > 0) {

   while ($row = $result->fetch_assoc()) {

   echo "<div class = 'faq'>";
   echo "<div class = 'faqtekst>'";
   echo "<h1>". $row["Kategori"] ."</h1>";
   echo "<h2>". $row["Navn"] ."</h2>";
   echo "<h3>". $row["FAQtekst"] .",-</h3>";
   echo "</div>";
   echo "</div>";


   }
} else {
   echo "<tr><td colspan='3'>No records found</td></tr>";
}
?>
</body>
</html>
<?php

?>