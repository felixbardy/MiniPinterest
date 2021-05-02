<?php
  session_start();
  require_once("./func/bd.php");
  require_once("./func/bd_images.php");
  require_once("./func/interface_generation.php");
  $_SESSION["connection"] = getConnection("localhost", "root", "", "images");
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
    echo generatePageHeader("Accueil");
    ?>
    <form name="select_category" action="" method="GET">
      <div class="input-group mb-3">
        <select name="category" id="category">
          <option value="all" class="form-control">Toutes les photos</option>
          <?php
              $categories = getAllCategories($_SESSION["connection"]);
              foreach($categories as $category)
              {
                // Si la catégorie a été séléctionée, l'afficher comme telle
                if (!is_null($_GET["category"]) && $_GET["category"] == $category["catId"])
                  echo "<option value=" . strval($category["catId"]) . " selected>" . $category["nomCat"] . "</option>\n";
                else
                  echo "<option value=" . strval($category["catId"]) . ">" . $category["nomCat"] . "</option>\n";
              }
          ?>
        </select>
        <button type="submit" class="btn btn-primary">
          Filtrer
        </button>
      </div>
    </form>
    <br>
    <?php
        //On récupère les images à afficher
        if (!array_key_exists("category", $_GET) || $_GET["category"] == "all")
          $images = getAllVisibleImages($_SESSION["connection"]);
        else
          $images = getVisibleImagesFromCategoryID($_SESSION["connection"], $_GET["category"]);
        
        echo generateImageGallery($images);

    ?>
    </body>
</html>