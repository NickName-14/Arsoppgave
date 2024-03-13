<?php
session_start();
require_once "config.php";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    
    if (isset($_COOKIE["bruker"])) {
        
        $bruker = $_COOKIE["bruker"];
        
      
        $sql = "SELECT * FROM login WHERE bruker = ?";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("s", $bruker);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows === 1) {
            $sql2 = "SELECT id, navn, bruker, passord, admin FROM login WHERE bruker ='".$bruker."'";
            
            if ($stmt = $link->prepare($sql2)) {
                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($id, $navn, $username, $password, $admin);

                        if ($stmt->fetch()) {
                            

                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["navn"] = $navn;
                            $_SESSION["bruker"] = $username;
                            $_SESSION["passord"] = $password;
                            $_SESSION["admin"] = $admin;
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hjem-Digistore</title>
    <link rel="icon" type="image/x-icon" href="Bilder/Logo/IconAarsoppgave.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="Ikoner">
        <a href="handlevogn.php"><img src="Bilder/SVG/conversation-svgrepo-com.svg" height="50px" alt=""></a>
        <div class="Meny">
    
        <ul class="TopNav">
        <a href="index.php" id="Menyaktiv"><h3>Hjem</a>
        <a href="Produktoversikt.php" class="Menyknapp">Produkter</a>
        <a href="FAQ.php"class="Menyknapp">FAQ</h3></a>
       </ul>
     </div>
        <a href="profil.php"><img src="Bilder/SVG/user-svgrepo-com.svg"  height="50px" alt=""></a>
    </div>

</body>
</html>
<?php

?>