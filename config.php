<?php
$servername = "10.200.1.108";
$username = "root";
$password = "Admin";
$dbname = "mydb";

// koble til databasen
$link = new mysqli($servername, $username, $password, $dbname);

// sjekke om det fungerte
if ($link->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>