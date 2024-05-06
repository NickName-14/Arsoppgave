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
    <title>Handlevogn-Digistore</title>
    <link rel="icon" type="image/x-icon" href="Bilder/Logo/IconAarsoppgave.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="Menybilde">
    <img src="Bilder/Logo/LogoAarsoppgave.png" alt="" width="15%">
    </div>
<div class="Ikoner">
        <a href="handlevogn.php"><img src="Bilder/SVG/conversation-svgrepo-com.svg" id="profil" height="50px" alt=""></a>
        <div class="Meny">
    
        <ul class="TopNav">
        <a href="index.php" class="Menyknapp"><h3>Hjem</a>
        <a href="Produktoversikt.php" class="Menyknapp">Produkter</a>
        <a href="FAQ.php"class="Menyknapp">FAQ</h3></a>
       </ul>
     </div>
     
        <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg"  height="50px" alt=""></a>
    </div>
    <h1>Handlevogn</h1>
    <?php

$sql = "SELECT Produkt_handlevognid, Antall FROM Handlevogn WHERE Kunde_handlevognid = '" . $_SESSION['id'] . "'";

$result_outer = $link->query($sql);

if ($result_outer->num_rows > 0) {
    while ($row_outer = $result_outer->fetch_assoc()) {
        $produkt_handlevognid = $row_outer['Produkt_handlevognid'];

        $sql_inner = "SELECT Produktid, ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde FROM Produkter WHERE Produktid = '" . $produkt_handlevognid . "'";
        $result_inner = $link->query($sql_inner);

        if ($result_inner->num_rows > 0) {
            while ($row_inner = $result_inner->fetch_assoc()) {
                echo "<div class='HandlevognElement'>";
                echo "<img src='" . $row_inner["ProduktBilde"] . "' height='100px'>";
                echo "<div>";
                echo "<h2>".$row_inner['ProduktNavn']."</h2>";
                echo "<h3>".$row_inner['ProduktKategori']."</h3>";
                echo "</div>";
                echo "<h2>". $row_inner["ProduktPris"] .",-</h2>";
                echo "<form method='post'>";
                echo "<input type='hidden' name='delete_produktid' value='" . $row_inner['Produktid'] . "'>";
                echo "<button type='submit' name='delete_submit'>Fjern</button>";
                echo "<input type='hidden' name='edit_produktid' value='" . $row_inner['Produktid'] . "'>";
                echo "<select name='antall'>";
                for ($i = 1; $i <= 10; $i++) {
                    $selected = ($i == $row_outer['Antall']) ? "selected" : "";
                    echo "<option value='$i' $selected>$i</option>";
                }
                echo "</select>";
                echo "<button type='submit' name='edit_submit'>Endre</button>";
                
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "<tr><td colspan='3'>Du har ingen produkter i handlevognene</td></tr>";
        }
    }
} else {
    echo "<tr><td colspan='3'>Du har ingen produkter i handlevognene</td></tr>";
}

if (isset($_POST['delete_submit'])) {
    $delete_produktid = $_POST['delete_produktid'];
    $delete_sql = "DELETE FROM Handlevogn WHERE Produkt_handlevognid = '$delete_produktid' AND Kunde_handlevognid = '" . $_SESSION['id'] . "'";
    if ($link->query($delete_sql) === TRUE) {
        header("location: handlevogn.php");
    } else {
        echo "Error deleting record: " . $link->error;
    }
}

if (isset($_POST['edit_submit'])) {
    $edit_produktid = $_POST['edit_produktid'];
    $new_quantity = $_POST['antall'];

    $edit_sql = "UPDATE Handlevogn SET Antall = '$new_quantity' WHERE Produkt_handlevognid = '$edit_produktid' AND Kunde_handlevognid = '" . $_SESSION['id'] . "'";

    if ($link->query($edit_sql) === TRUE) {
        header("location: handlevogn.php");
    } else {
        echo "Error updating record: " . $link->error;
    }
}

$link->close();

?>
<a href="bestiling.php">Til kassen</a>

</body>
</html>
