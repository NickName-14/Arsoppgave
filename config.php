<?php
$servername = "localhost";
$username = "root";
$password = "Admin";
$dbname = "Årsoppgave";

// koble til databasen
$link = new mysqli($servername, $username, $password, $dbname);

// sjekke om det fungerte
if ($link->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>