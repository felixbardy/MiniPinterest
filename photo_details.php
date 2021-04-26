<?php
    session_start();
    require_once("./func/bd_images.php");
    require_once("./func/interface_generation.php");
    $_SESSION["connection"] = getConnection("localhost", "root", "", "images");
    
    if (is_null($_GET["photoId"]))
    {
        header("Location: ./index.php");
        exit;
    }
    else 
    {
      $photo = getImageByID($_SESSION["connection"], $_GET["photoId"]);
      $category = getCategoryByID($_SESSION["connection"],$photo["catId"]);
    }
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo "Photo n°" . $photo["photoId"]; ?>
        </title>
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="./style/style.css">

        <script src="./bootstrap/bootstrap.min.js"></script>
    </head>
    <body>
        <?php echo generatePageHeader(null); ?>
        <h1><b><?php echo "Détails sur " . $photo["nomFich"] . " (id=" . $photo["photoId"] . "):"; ?></b></h1>
        <div class="row">
            <div class="col-md">
                <?php echo "<img class=\"img-responsive\" src=\"img/" . $photo["nomFich"] . "\">"; ?>
            </div>
            <div class="col-md">
                <?php echo generateImageDetails($photo, $category); ?>
            </div>
        </div>
    </body>
</html>