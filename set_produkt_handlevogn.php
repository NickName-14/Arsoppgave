<?php
session_start();

require_once "config.php";

if (isset($_GET['produktid'])) {
    $kunde = $_SESSION['id'];
    $produkt = $_GET['produktid'];

    $check_sql = "SELECT * FROM Handlevogn WHERE Kunde_handlevognid = ? AND Produkt_handlevognid = ?";
    if ($check_stmt = $link->prepare($check_sql)) {
        $check_stmt->bind_param("ii", $kunde, $produkt);
        $check_stmt->execute();
        $check_stmt->store_result();

        if ($check_stmt->num_rows > 0) {
            $update_sql = "UPDATE Handlevogn SET antall = antall + 1 WHERE Kunde_handlevognid = ? AND Produkt_handlevognid = ?";
            if ($update_stmt = $link->prepare($update_sql)) {
                $update_stmt->bind_param("ii", $kunde, $produkt);
                $update_stmt->execute();
                header("location: Produktoversikt.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } else {
            $insert_sql = "INSERT INTO Handlevogn (Kunde_handlevognid, Produkt_handlevognid, antall) VALUES (?, ?, 1)";
            if ($insert_stmt = $link->prepare($insert_sql)) {
                $insert_stmt->bind_param("ii", $kunde, $produkt);
                $insert_stmt->execute();
                header("location: Produktoversikt.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        $check_stmt->close();
    }
}

exit;


?>