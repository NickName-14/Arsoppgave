<?php
$servername = "localhost";
$username = "DigiStore";
$password = "IMKuben1337!";
$dbname = "Årsoppgave";

// koble til databasen
$link = new mysqli($servername, $username, $password, $dbname);

// sjekke om det fungerte
if ($link->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>