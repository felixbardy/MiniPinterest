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
    <form name="select_category" action="" method="GET">
      <select name="category" id="category">
        <option value="all">Toutes les photos</option>
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
      <input type="submit" value="Filtrer">
    </form>
    </body>
</html>