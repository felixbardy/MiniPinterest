<?php 

session_start();
$_SESSION["logged"] = false;
$_SESSION["username"] = false;
$_SESSION["admin"] = false;

header("Location: ./index.php");
exit;

?>