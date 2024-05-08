<?php
echo "<b>File to be uploaded: </b>" . $_FILES["uploadfile"]["name"] . "<br>";
echo "<b>Type: </b>" . $_FILES["uploadfile"]["type"] . "<br>";
echo "<b>File Size: </b>" . $_FILES["uploadfile"]["size"]/1024 . "<br>";
echo "<b>Store in: </b>" . $_FILES["uploadfile"]["tmp_name"] . "<br>";

if (file_exists($_FILES["uploadfile"]["tmp_name"])){
    echo "<h3>File Successfully Uploaded</h3>";

    $source_tmp_name = $_FILES["uploadfile"]["tmp_name"]; 
    $source_name = $_FILES["uploadfile"]["name"]; 
    $destination = 'Bilder/ProduktBilder/' . $source_name; 

    // Attempt to move the file
    if (move_uploaded_file($source_tmp_name, $destination)) {
        echo "File moved successfully.";
        header("location: admin.php");
    } else {
        echo "Error moving file.";
    }
} else {
    echo "<h3>The file was not uploaded or does not exist</h3>";
}
?>
