<?php
session_start();

require_once "config.php";
   


$username_err = $password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    if (isset($_GET["bruker"]) && isset($_GET["passord"])) {
        
        $username = $_GET["bruker"];
        $password = $_GET["passord"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
       
        if (empty($username)) {
            $username_err = "Brukernavn er nødvendig.";
        }

        if (empty($password)) {
            $password_err = "Passord er nødvendig.";
        }

       
        if (empty($username_err) && empty($password_err)) {
           
            $sql = "SELECT Kunderid, Navn, Brukernavn, 'E-post', Passord, Admin FROM Kunder WHERE Brukernavn = '" . $username . "' ";

            if ($stmt = $link->prepare($sql)) {

                if ($stmt->execute()) {
                    $stmt->store_result();

                    if ($stmt->num_rows == 1) {
                        $stmt->bind_result($id, $navn, $username, $e_post, $password, $admin);

                        if ($stmt->fetch()) {
                            if (password_verify($password, $hashed_password)) {
                                
                                session_start();

                               
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["navn"] = $navn;
                                $_SESSION["brukernavn"] = $username;
                                $_SESSION["e-post"]  = $e_post;
                                $_SESSION["passord"] = $password;
                                $_SESSION["admin"] = $admin;
                                
                                if (isset($_GET["remember_me"]) && $_GET["remember_me"] == "on") {
                                    
                                    setcookie("bruker", $username, time() + 3600 * 24 * 30, "/"); 
                                    setcookie("pass", $password, time() + 3600 * 24 * 30, "/");
                                }
                                header("location: profil.php");
                                exit();
                            } else {
                                $password_err = "Passordet er feil.";
                            }
                        }
                    } else {
                        $username_err = "Fant ingen Brukere med det bruker navnet.";
                    }
                } else {
                    echo "Passordet eller bruker navnet er feil.";
                }

                $stmt->close();
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
    <title>Login-Digistore</title>
    <link rel="icon" type="image/x-icon" href="Bilder/Logo/IconAarsoppgave.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="GET" class="form-group">

      
        <div class="containerlogin">
          <label for="uname"><b>Brukernavn</b></label>
          <input type="text" placeholder="Skriv in Brukernavn" name="bruker">
      
          <label for="psw"><b>Passord</b></label>
          <input type="password" placeholder="Skriv in Passord" name="passord">
              
          <button type="submit" id="loginbtn">Login</button>
          <label>
            <input type="checkbox" checked="checked" name="remember_me"> Remember me
          </label>
        </div>
      
        <div class="wrapperlog" style="background-color:#f1f1f1">
          <a class="psw" href="registrering.php">Registrering</a>
          <a class="psw" href="FAQ.php">FAQ</a>
        </div>
      </form>

<?php
echo "<div class='error'>";
echo $password_err;
echo $username_err;
echo "</div>";
?>
</body>
</html>