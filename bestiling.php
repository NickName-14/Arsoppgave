<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
} 


$status = "Under arbeid";
$current_time = time();

$sql = "INSERT INTO Bestilinger (Kunde, Dato, Status) VALUES (?, ?, ?)";

if ($stmt = $link->prepare($sql)) {
    $stmt->bind_param("sss", $param_Kunde, $param_Dato, $param_status,);
    $param_Kunde = $_SESSION["id"];
    $param_Dato = date("Y-m-d H:i:s", $current_time); 
    $param_status = $status;

    if ($stmt->execute()) {
        $bestiling = $stmt->insert_id;
        $stmt->close();




        $sql = "SELECT Produkt_handlevognid, Antall FROM Handlevogn WHERE Kunde_handlevognid = ?";
        if ($stmt_outer = $link->prepare($sql)) {
            $stmt_outer->bind_param("i", $_SESSION['id']);
            $stmt_outer->execute();
            $result_outer = $stmt_outer->get_result();
        
            while ($row_outer = $result_outer->fetch_assoc()) {
                $produkt_handlevognid = $row_outer['Produkt_handlevognid'];
                $antall = $row_outer['Antall'];
        
                $sql_inner = "SELECT Produktid, ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde FROM Produkter WHERE Produktid = ?";
                if ($stmt_inner = $link->prepare($sql_inner)) {
                    $stmt_inner->bind_param("i", $produkt_handlevognid);
                    $stmt_inner->execute();
                    $result_inner = $stmt_inner->get_result();
        
                    if ($row_inner = $result_inner->fetch_assoc()) {
                        $produkt = $row_inner['Produktid'];
                        
        
                        $sql_insert = "INSERT INTO Produkter_I_Bestiling (Produkt, Bestiling, Antall) VALUES (?, ?, ?)";
                        if ($stmt_insert = $link->prepare($sql_insert)) {
                            $stmt_insert->bind_param("iii", $produkt, $bestiling, $antall);

                            $stmt_insert->execute();
                            $stmt_insert->close();
                        }
                    }
                    $stmt_inner->close();
                }
            }
            $stmt_outer->close();
            header("location: bestilingoversikt.php");
            exit;
        } else {
            echo "Something went wrong. Please try again later.";
        }
        
}
}


?>


