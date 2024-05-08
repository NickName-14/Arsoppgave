<?php

require_once "config.php";

if (($_SESSION["admin"] == "True")) {
    echo "<a href='admin.php' class='Menyknapp'><h3>Admin</a>";
}
?>