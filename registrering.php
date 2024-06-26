<?php
require_once "config.php";


$navn = $username = $password = $confirm_password = "";
$navn_err = $username_err = $password_err = $confirm_password_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "skriv in et navn.";
    } else {
     
        $sql = "SELECT Kunderid FROM Kunder WHERE navn = ?";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("s", $param_navn);
            $param_navn = trim($_POST["navn"]);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $navn_err = "Dette navnet er alerede i bruk.";
                } else {
                    $navn = trim($_POST["navn"]);
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
  
    if (empty(trim($_POST["username"]))) {
        $username_err = "skriv in et brukernavn";
    } else {
      
        $sql = "SELECT Kunderid FROM Kunder WHERE Brukernavn = ?";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $username_err = "Dette brukernavnet er alerede i bruk.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

  
    if (empty(trim($_POST["password"]))) {
        $password_err = "skriv in et passord.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Passordet må ha i hvert fall 6 tegn.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "skriv in passordet igjen.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if ($password != $confirm_password) {
            $confirm_password_err = "Passordet du skrev in var ikke likt";
        }
    }
    

   $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
      
        $sql = "INSERT INTO Kunder (navn, brukernavn, passord, admin) VALUES (?, ?, ?, 'false')";

        if ($stmt = $link->prepare($sql)) {
            $stmt->bind_param("sss", $param_navn, $param_username, $param_password);
            $param_navn = $navn;
            $param_username = $username;
            $param_password = $hashedPassword;

            if ($stmt->execute()) {
               
                header("location: login.php");
            } else {
                echo "Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }

   
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrering-Digistore</title>
    <link rel="icon" type="image/x-icon" href="Bilder/Logo/IconAarsoppgave.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="Menybilde">
    <img src="Bilder/Logo/LogoAarsoppgave.png" alt="" width="15%">
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> " method="post" class="registrer-form">
          <h2>Register</h2>
          <div>
                <label>Navn</label>
                <input type="text" name="navn" placeholder="Skriv in navnet ditt"
                    class="form-control <?php echo (!empty($navn_err)) ? 'is-invalid' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span class="invalid-feedback">
                    <?php echo $username_err; ?>
                </span>
          
                <label>Brukernavn</label>
                <input type="text" name="username" placeholder="Lag et Brukernavn"
                    class="form-control <?php echo (!empty($username_err)) ? 'er feil' : ''; ?>"
                    value="<?php echo $username; ?>">
                <span class="invalid-feedback">
                    <?php echo $username_err; ?>
                </span>
            
                <label>Passord</label>
                <input type="password" name="password" placeholder="Lag et Passord"
                    class="form-control <?php echo (!empty($password_err)) ? 'er feil' : ''; ?>"
                    value="<?php echo $password; ?>">
                <span class="invalid-feedback">
                    <?php echo $password_err; ?>
                </span>
           
                <label>Verifiser Passord</label>
                <input type="password" name="confirm_password" placeholder="Skriv in passordet på nytt"
                    class="form-control <?php echo (!empty($confirm_password_err)) ? 'er feil' : ''; ?>"
                    value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback">
                    <?php echo $confirm_password_err; ?>
                </span>
            </div>
            <div class="regbtn">
                <input type="submit" class="Registrerbtn" value="Registrer">
                <input type="reset" class="Cancel" value="Cancel">
            </div>
            <p>Har du en bruker? <a href="login.php">Login her</a>.</p>
        </form>
</body>

</html>