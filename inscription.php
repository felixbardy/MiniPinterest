<?php
    session_start();
    require_once("./func/bd_images.php");
    require_once("./func/interface_generation.php");
    $_SESSION["connection"] = getConnection("localhost", "root", "", "images");
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            Inscription
        </title>
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">

        <script src="./bootstrap/bootstrap.min.js"></script>
    </head>
    <body>
        <?php echo generatePageHeader("Inscription"); ?>
    </body>
</html>