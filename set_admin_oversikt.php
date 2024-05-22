<?php
session_start();

if (isset($_GET['ProduktiBestilingId'])) {
    $_SESSION['bestilingsid'] = $_GET['ProduktiBestilingId'];
}

header("Location: adminDetaljer.php"); 
exit;
?>