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

    $stmt->execute;
    $stmt->close();
}

?>


