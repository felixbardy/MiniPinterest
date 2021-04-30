<?php
function generatePageHeader($place)
{
  $header  = "";
  $header .= "<nav class=\"navbar navbar-expand-md navbar-dark bg-dark\">
  <a class=\"navbar-brand\" href=\"./index.php\">Mini-Pinterest</a>
  <!-- Bouton affiché pour les petites interfaces -->
  <button class=\"navbar-toggler\" type=\"button\" data-toggle=\"collapse\" data-target=\"#navbarsExample04\" aria-controls=\"navbarsExample04\" aria-expanded=\"false\" aria-label=\"Toggle navigation\">
    <span class=\"navbar-toggler-icon\"></span>
  </button>

  <div class=\"collapse navbar-collapse\" id=\"navbarsExample04\">
    <ul class=\"navbar-nav mr-auto\">
      <li class=\"nav-item dropdown\">
        <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"dropdown04\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">Ajouter</a>
        <div class=\"dropdown-menu\" aria-labelledby=\"dropdown04\">
          <a class=\"dropdown-item\" href=\"#\">Catégorie</a>
          <a class=\"dropdown-item\" href=\"./ajouter_image.php\">Image</a>

        </div>
      </li>
    </ul>
    <ul class=\"navbar-nav\">";
    if (!isset($_SESSION["logged"]) || !$_SESSION["logged"])
    {
      $header .= "<li class=\"nav-item";
      if ($place == "Connexion") $header .= " active";
      $header .= "\">
        <a class=\"nav-link\" href=\"./connexion.php\">Connexion</a>
      </li>
      <li class=\"nav-item";
      if ($place == "Inscription") $header .= " active";
      $header .= "\">
        <a class=\"nav-link\" href=\"./inscription.php\">Inscription</a>
      </li>";
    }
    else
    {
      $header .= "<li class=\"nav-item navbar-text\">Bonjour " . $_SESSION["username"] . ".</li>";
      $header .= "<li class=\"nav-item\">
        <a class=\"nav-link\" href=\"./deconnexion.php\">Déconnexion</a>
      </li>";
    }
    $header .= "</ul>
  </div>
  </nav>";
  return $header;
}

function generateImageGallery($images)
{
    $gallery = '';
    $number_of_images = count($images);
    $gallery .= "<div class=\"img-gallery\">";
    foreach($images as $index => $image)
      $gallery .= "<a href='./photo_details.php?photoId=" . strval($image["photoId"]) . "'><img src='img/" . $image["nomFich"] . "'></a>\n";
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

function generateError($message)
{
  return 
  '<div class="row alert alert-danger"
    role="alert"
  >' .
    $message .
  '</div>';
}

?>