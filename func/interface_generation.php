<?php

function generatePageHeader($place)
{
  $header = "";
  $header .= "<nav class=\"navbar navbar-expand-lg navbar-light bg-white\">\n"
         . "  <ul class=\"navbar-nav me-auto mb-2 mb-lg-0\">\n";

  $header .= "    <li class=\"nav-item";
  if ($place == "Home") $header .= " active";
  $header .= "\">\n";
  $header .= "      <a class=\"nav-link\" href=\"./index.php\">Acceuil</a>\n";
  $header .= "    </li>\n";

  $header .= "    <li class=\"nav-item";
  if ($place == "Inscription") $header .= " active";
  $header .= "\">\n";
  $header .= "      <a class=\"nav-link\" href=\"./inscription.php\">Inscription</a>\n";
  $header .= "    </li>\n";

  $header .= "    <li class=\"nav-item";
  if ($place == "Connection") $header .= " active";
  $header .= "\">\n";
  $header .= "      <a class=\"nav-link\" href=\"./connexion.php\">Connexion</a>\n";
  $header .= "    </li>\n";

  $header .= "  </ul>\n";
  $header .= "</nav>\n";

  return $header;
}

function generateImageGallery($images)
{
    $gallery = '';
    $number_of_images = count($images);
    $gallery .= "<div class=\"col-md-6 col-sm-9 col-xs-12\">";
    foreach($images as $index => $image)
      $gallery .= "<a href='./photo_details.php?photoId=" . strval($image["photoId"]) . "'><img class=\"img-responsive\" width=\"33%\" src='img/" . $image["nomFich"] . "'></a>\n";
    $gallery .= "</div>\n";
    return $gallery;
}

function generateImageDetails($photo, $category)
{
  $table = "<table class=\"table\">\n"
         . "  <tr>\n"
         . "    <th>Description</th>\n"
         . "    <td>" . $photo["description"] . "</td>\n"
         . "  </tr>\n"
         . "  <tr>\n"
         . "    <th>Nom du fichier</th>\n"
         . "    <td>" . $photo["nomFich"] . "</td>\n"
         . "  </tr>\n"
         . "  <tr>\n"
         . "    <th>Catégorie</th>\n"
         . "    <td><a href=\"./index.php?category=" . strval($category["catId"]) . "\">" . $category["nomCat"] . "</a></td>\n"
         . "  </tr>\n"
         . "</table>\n";
  
  return $table;
  
}

?>