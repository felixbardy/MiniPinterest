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
  if ($place == "Connection") $header .= " active";
  $header .= "\">\n";
  $header .= "      <a class=\"nav-link\" href=\"./connection.php\">Connection</a>\n";
  $header .= "    </li>\n";
  $header .= "  </ul>\n";
  $header .= "</nav>\n";

  return $header;
}

function generateImageGallery($images)
{
    $gallery = "";
    $number_of_images = count($images);
    foreach($images as $image)
    {
      $gallery .= "<a href='./photo_details.php?photoId=" . strval($image["photoId"]) . "'><img src='img/" . $image["nomFich"] . "'></a><br>";
    }
    return $gallery;
}
?>