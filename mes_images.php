<?php
  session_start();
  require_once("./func/bd.php");
  require_once("./func/bd_images.php");
  require_once("./func/bd_users.php");
  require_once("./func/interface_generation.php");
  $_SESSION["connection"] = getConnection("localhost", "root", "", "images");
  
  // Si l'utilisateur n'est pas connecté,
  // le rediriger vers la page de connection
  if (!isset($_SESSION["logged"]) || !$_SESSION["logged"])
  {
    header("Location: ./connexion.php");
    exit;
  }
  
  // Si l'utilisateur est administrateur
  if ( isset($_SESSION["admin"]) && $_SESSION["admin"]
  // A renseigné l'agument user
  && isset($_GET["user"])
  // Et le nom d'utilisateur existe
  && !checkNicknameAvailability($_SESSION["connection"], urldecode($_GET["user"]))
  // Afficher les images de cet utilisateur
  ) $user = urldecode($_GET["user"]);
  // Sinon, prendre l'utilisateur actuel
  else $user = $_SESSION["username"];
  ?>

<!doctype html>
<html lang="fr">
  <head>
      <meta charset="utf-8">
      <title>Mes images</title>
      <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
      <link rel="stylesheet" href="./style/style.css">

      <script src="./lib/js/jquery-3.3.1.min.js"></script>
      <script src="./lib/js/popper.min.js"></script>
      <script src="./lib/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php 
  echo generatePageHeader("Mes_images");
  ?>
  <!--// TODO Ajouter des filtres //-->
  <?php
  $images = getImagesFromUser(
    $_SESSION["connection"],
    $_SESSION["username"]
  );
  echo generateImageGallery($images);
  ?>
  </body>
</html>