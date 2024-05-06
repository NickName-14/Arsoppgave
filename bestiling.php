<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
} 



$current_time = time();

$sql = "INSERT INTO Bestilinger (Kunde, Dato) VALUES (?, ?)";

if ($stmt = $link->prepare($sql)) {
    $stmt->bind_param("ss", $param_Kunde, $param_Dato);


    $param_Kunde = $_SESSION["id"];
    $param_Dato = date("Y-m-d H:i:s", $current_time); 

    if ($stmt->execute()) {
        $bestiling = $stmt->insert_id;
        $stmt->close();




        $sql = "SELECT Produkt_handlevognid, Antall FROM Handlevogn WHERE Kunde_handlevognid = '" . $_SESSION['id'] . "'";

$result_outer = $link->query($sql);

if ($result_outer->num_rows > 0) {
    while ($row_outer = $result_outer->fetch_assoc()) {
        $produkt_handlevognid = $row_outer['Produkt_handlevognid'];

        $sql_inner = "SELECT Produktid, ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde FROM Produkter WHERE Produktid = '" . $produkt_handlevognid . "'";
        $result_inner = $link->query($sql_inner);

        if ($result_inner->num_rows > 0) {
            while ($row_inner = $result_inner->fetch_assoc()) {
        
        $produkt = $row_inner['Produktid'];
        $antall = $row_outer['Antall'];
        
        $sql = "INSERT INTO Produkter_I_Bestiling (Produkt, Bestiling, Antall) VALUES (?, ?, ?)";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("iii", $param_produkt, $param_bestiling, $param_antall);
            $param_produkt = $produkt;
            $param_bestiling = $bestiling;
            $param_antall = $antall;

            if ($stmt->execute()) {
                header("location: bestilingoversikt.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }        

            }
        }
       


        }
    }
}
}
}


?>


