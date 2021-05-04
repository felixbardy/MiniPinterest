<?php

function getElapsedTimeString($start, $stop)
{
  $delta = $stop - $start;
  $h = intval($delta / 3600);
  $m = intval($delta / 60 - 60 * $h);
  return "$h" . "H $m" . "min";
}
function generatePageHeader($place)
{
  if (isset($_SESSION["logged_at"]))
  {
    $now = time();
  }

  $header  = "";
  $header .= "<nav class=\"navbar navbar-expand-md sticky-top navbar-dark bg-dark\">
  <a class=\"navbar-brand\" href=\"./index.php\">Mini-Pinterest</a>
  <!-- Bouton affiché pour les petites interfaces -->
  <button 
    class=\"navbar-toggler\" type=\"button\"
    data-toggle=\"collapse\" data-target=\"#mainNavbar\"
    aria-controls=\"mainNavbar\" aria-expanded=\"false\"
    aria-label=\"Toggle navigation\"
    >
    <span class=\"navbar-toggler-icon\"></span>
  </button>

  <div class=\"collapse navbar-collapse\" id=\"mainNavbar\">
    <ul class=\"navbar-nav mr-auto\">
      <li class=\"nav-item";
      if ($place == "Accueil") $header .= " active";
      $header .= "\">
        <a
          class=\"nav-link\"
          href=\"./index.php\"
        >
          Accueil
        </a>
      </li>
      <li class=\"nav-item";
      if ($place == "Mes_images") $header .= " active";
      $header .= "\">
        <a
          class=\"nav-link\"
          href=\"./mes_images.php\"
        >
          Mes images
        </a>
      </li>";
      // Si l'utilisateur est administrateur
      if (isset($_SESSION["admin"]) && $_SESSION["admin"])
      {
        $header .= "<li class=\"nav-item";
        if ($place == "Statistiques") $header .= " active";
        $header .= "\">
        <a
          class=\"nav-link\"
          href=\"./statistiques.php\"
        >
          Statistiques
        </a>
        </li>";
      }
      $header .= "<li class=\"nav-item \">
        <a href=\"./ajouter_image.php\"><button class=\"btn btn-success\">Ajouter une image </button></a>
      </li>
    </ul>
    <ul class=\"navbar-nav\">";
    if (!isset($_SESSION["logged"]) || !$_SESSION["logged"])
    {
      $header .= "<li class=\"nav-item";
      if ($place == "Connexion") $header .= " active";
      $header .= "\">
        <a href=\"./connexion.php\"><button class=\"btn btn-secondary\">Connexion</button></a>
      </li>
      <li class=\"nav-item";
      if ($place == "Inscription") $header .= " active";
      $header .= "\">
        <a href=\"./inscription.php\"><button class=\"btn btn-success\">Inscription</button></a>
      </li>";
    }
    else
    {
      $header .= "<li class=\"nav-item navbar-text\">
                    Bonjour " . $_SESSION["username"] . 
                 ". (Connecté depuis " . getElapsedTimeString($_SESSION["logged_at"], $now) . " )" .
                 "</li>";
      $header .= "<li class=\"nav-item\">
        <a href=\"./deconnexion.php\"><button class=\"btn btn-secondary\">Déconnexion</button></a>
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
    {
      $gallery .= "<a href='./photo_details.php?photoId=" . strval($image["photoId"]) . "'><img";
      if($image["hidden"]) $gallery .= " class=\"hidden-image\"";
      $gallery .=" src='img/" . $image["nomFich"] . "' alt=\"" . $image["description"] . "\"></a>\n";
    }
    $gallery .= "</div>\n";
    return $gallery;
}

function generateImageDetails($photo, $category)
{
  if (is_null($photo["auteur"]))
    $auteur = "aucun";
  else
    $auteur = $photo["auteur"];

  if ($photo["hidden"])
    $hidden = "Oui";
  else
    $hidden = "Non";
           
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
         . "    <th>Auteur</th>\n"
         . "    <td>" . $auteur . "</td>\n"
         . "  </tr>\n"
         . "  <tr>\n"
         . "    <th>Catégorie</th>\n"
         . "    <td><a href=\"./index.php?category=" . strval($category["catId"]) . "\">" . $category["nomCat"] . "</a></td>\n"
         . "  </tr>\n"
         . "  <tr>\n"
         . "    <th>Cachée</th>\n"
         . "    <td>$hidden</td>\n"
         . "  </tr>\n"
         . "</table>\n";
  
  return $table;
}

function generateImageModifButton()
{
  // Bouton d'ouverture des contrôles de modification
  $button = "<button type=\"button\""
       . "class=\"btn btn-primary\""
       . "data-toggle=\"modal\""
       . "data-target=\"#editModal\""
       . ">\n"
       . "  Modifier\n"
       . "</button>\n";
  return $button;
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