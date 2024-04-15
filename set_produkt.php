<?php
session_start();

if (isset($_GET['produktid'])) {
    $_SESSION['produktid'] = $_GET['produktid'];
}

header("Location: produkt.php"); 
exit;
?>