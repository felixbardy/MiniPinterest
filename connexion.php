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
            Connexion
        </title>
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">

        <script src="./bootstrap/bootstrap.min.js"></script>
    </head>
    <body>
        <?php echo generatePageHeader("Connexion"); ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 offset-md-5">
                    <h1><b>Connexion</b></h1>
                    <form name="log_in" action="" method="POST">
                        <div class="input-group">
                            <div class="row">
                                <h3>Identifiant</h3>
                            </div>
                            <div class="row">
                                <input class="form-control" type="text" name="username" placeholder="username">
                            </div>
                            <div class="row">
                                <h3>Mot de passe</h3>
                            </div>
                            <div class="row">
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="row">
                                <input class="form-control" type="submit" value="Se connecter">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>