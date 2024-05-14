<?php
session_start();
require_once "config.php";

$navn = $_POST["navn"];
$kategori = $_POST["kategori"];
$teskt = $_POST["tekst"];

$sql = "INSERT INTO FAQ (Navn, Kategori, FAQtekst) VALUES (?,?,?)";

if ($stmt = $link->prepare($sql)) {
    $stmt->bind_param("sss", $param_navn, $param_kategori, $param_tekst);
    $param_navn = $navn;
    $param_kategori = $kategori;
    $param_tekst = $teskt;

    if ($stmt->execute()) {
        header("location: FAQ.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }

    $stmt->close();
}
?>