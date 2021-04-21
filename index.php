<?php
  session_start();
  require_once("./func/bd.php");
  require_once("./func/bd_images.php");
  $_SESSION["connection"] = getConnection("localhost", "root", "", "images");
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Projet BDW1 2021</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        Hello, world!
    </body>
</html>