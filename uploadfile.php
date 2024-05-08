<?php
session_start();
require_once "config.php";

echo "<b>File to be uploaded: </b>" . $_FILES["uploadfile"]["name"] . "<br>";
echo "<b>Type: </b>" . $_FILES["uploadfile"]["type"] . "<br>";
echo "<b>File Size: </b>" . $_FILES["uploadfile"]["size"]/1024 . "<br>";
echo "<b>Store in: </b>" . $_FILES["uploadfile"]["tmp_name"] . "<br>";

if (file_exists($_FILES["uploadfile"]["tmp_name"])){
    echo "<h3>File Successfully Uploaded</h3>";

    $source_tmp_name = $_FILES["uploadfile"]["tmp_name"]; 
    $source_name = $_FILES["uploadfile"]["name"]; 
    $destination = 'Bilder/ProduktBilder/' . $source_name; 

    if (move_uploaded_file($source_tmp_name, $destination)) {
        echo "File moved successfully.";
        echo $source_name;
    } else {
        echo "Error moving file.";
    }
} else {
    echo "<h3>The file was not uploaded or does not exist</h3>";
}

$filbane = "Bilder/ProduktBilder/";
$navn= $_POST["navn"];
$pris= $_POST["pris"];
$merke= $_POST["merke"];
$kategori= $_POST["kategori"];
$info= $_POST["info"];
$bilde = $filbane . $source_name;

$sql = "INSERT INTO Produkter (ProduktNavn, ProduktPris, ProduktMerke, ProduktKategori, ProduktInfo, ProduktBilde) VALUES (?,?,?,?,?,?)";

if ($stmt = $link->prepare($sql)) {
    $stmt->bind_param("ssssss", $param_navn, $param_pris, $param_merke, $param_kategori, $param_info, $param_bilde);
    $param_navn = $navn;
    $param_pris = $pris;
    $param_merke = $merke;
    $param_kategori = $kategori;
    $param_info = $info;
    $param_bilde = $bilde;

    if ($stmt->execute()) {
        header("location: admin.php");
    } else {
        echo "Something went wrong. Please try again later.";
    }

    $stmt->close();
}

?>
