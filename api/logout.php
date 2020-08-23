<?php
session_start();
$_SESSION["loggedIn"] = "";
session_destroy();
header("Location: ../login.php");
?>