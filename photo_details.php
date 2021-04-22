<?php
    session_start();
    require_once("./func/bd_images.php");
    if (is_null($_SESSION["connection"]))
      $_SESSION["connection"] = getConnection("localhost", "root", "", "images");
    
    if (is_null($_GET["photoId"]))
    {
        header("Location: ./index.php");
        exit;
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title><?php ?></title>
    </head>
    <body>
        
    </body>
</html>