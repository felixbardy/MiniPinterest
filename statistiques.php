<?php
  session_start();
  require_once("./func/bd.php");
  require_once("./func/bd_images.php");
  require_once("./func/interface_generation.php");
  $_SESSION["connection"] = getConnection("localhost", "root", "", "images");

  // Si l'utilisateur n'est pas administrateur, il n'a rien à faire là
  if (!isset($_SESSION["admin"]) || !$_SESSION["admin"])
  {
      header("Location: ./index.php");
      exit;
  }

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Projet BDW1 2021</title>
    <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">

    <script src="./lib/js/jquery-3.3.1.min.js"></script>
    <script src="./lib/js/popper.min.js"></script>
    <script src="./lib/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php 
  echo generatePageHeader("Statistiques");
  ?>
  </body>
</html>