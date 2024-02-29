<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>En Nettbutikk</h1>
</body>
</html>
<?php
 if ($result->num_rows === 1) {
    $sql2 = "SELECT  navn FROM test";
    
    if ($stmt = $link->prepare($sql2)) {
        if ($stmt->execute()) {
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($navn);

                if ($stmt->fetch()) {

                    $_SESSION["navn"] = $navn;

                }
            }
        }
    }
}
?>