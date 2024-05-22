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
            <a href="index.php" class="Menyknapp"><h3>Hjem</h3></a>
            <a href="Produktoversikt.php" class="Menyknapp"><h3>Produkter</h3></a>
            <a href="FAQ.php" class="Menyknapp"><h3>FAQ</h3></a>
        </ul>
    </div>
    <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg" height="50px" alt=""></a>
</div>
<h1>Handlevogn</h1>
<?php
$totalpris = 0;

$sql = "SELECT Produkt_handlevognid, Antall FROM Handlevogn WHERE Kunde_handlevognid = ?";
if ($stmt_outer = $link->prepare($sql)) {
    $stmt_outer->bind_param("i", $_SESSION['id']);
    $stmt_outer->execute();
    $result_outer = $stmt_outer->get_result();

    if ($result_outer->num_rows > 0) {
        while ($row_outer = $result_outer->fetch_assoc()) {
            $produkt_handlevognid = $row_outer['Produkt_handlevognid'];

            $sql_inner = "SELECT Produktid, ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde FROM Produkter WHERE Produktid = ?";
            if ($stmt_inner = $link->prepare($sql_inner)) {
                $stmt_inner->bind_param("i", $produkt_handlevognid);
                $stmt_inner->execute();
                $result_inner = $stmt_inner->get_result();

                if ($result_inner->num_rows > 0) {
                    while ($row_inner = $result_inner->fetch_assoc()) {
                        echo "<div class='HandlevognElement'>";
                        echo "<img src='" . $row_inner["ProduktBilde"] . "' height='100px'>";
                        echo "<div>";
                        echo "<h2>".$row_inner['ProduktNavn']."</h2>";
                        echo "<h3>".$row_inner['ProduktKategori']."</h3>";
                        echo "<h2>". $row_inner["ProduktPris"] .",-</h2>";
                        echo "</div>";
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
                        $totalpris += $row_inner["ProduktPris"];
                    }
                } else {
                    echo "<div>Du har ingen produkter i handlevognene</div>";
                }
                $stmt_inner->close();
            }
        }
    } else {
        echo "<div>Du har ingen produkter i handlevognene</div>";
    }
    $stmt_outer->close();
}

if (isset($_POST['delete_submit'])) {
    $delete_produktid = $_POST['delete_produktid'];
    $delete_sql = "DELETE FROM Handlevogn WHERE Produkt_handlevognid = ? AND Kunde_handlevognid = ?";
    if ($stmt_delete = $link->prepare($delete_sql)) {
        $stmt_delete->bind_param("ii", $delete_produktid, $_SESSION['id']);
        if ($stmt_delete->execute()) {
            header("location: handlevogn.php");
        } else {
            echo "Error deleting record: " . $link->error;
        }
        $stmt_delete->close();
    }
}

if (isset($_POST['edit_submit'])) {
    $edit_produktid = $_POST['edit_produktid'];
    $new_quantity = $_POST['antall'];
    $edit_sql = "UPDATE Handlevogn SET Antall = ? WHERE Produkt_handlevognid = ? AND Kunde_handlevognid = ?";
    if ($stmt_edit = $link->prepare($edit_sql)) {
        $stmt_edit->bind_param("iii", $new_quantity, $edit_produktid, $_SESSION['id']);
        if ($stmt_edit->execute()) {
            header("location: handlevogn.php");
        } else {
            echo "Error updating record: " . $link->error;
        }
        $stmt_edit->close();
    }
}

$update_sql = "UPDATE Handlevogn SET Totalpris = ? WHERE Kunde_handlevognid = ?";
if ($stmt_update = $link->prepare($update_sql)) {
    $stmt_update->bind_param("ii", $totalpris, $_SESSION['id']);
    if (!$stmt_update->execute()) {
        echo "Something went wrong. Please try again later.";
    }
    $stmt_update->close();
}

$link->close();

echo "<h2>Din total pris blir: ". $totalpris." ,- </h2>";
?>
<br>
<h2><a href="bestiling.php">Til kassen</a></h2>

</body>
</html>
