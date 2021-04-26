<?php
    session_start();
    require_once("./func/bd_images.php");
    require_once("./func/bd_users.php");
    require_once("./func/interface_generation.php");
    $_SESSION["connection"] = getConnection("localhost", "root", "", "images");

    // Si les identifiants ont été rentrés, vérifier leur validité
    if ( !empty($_POST) )
    {   
        if ( // Si le pseudo est déjà pris...
            !checkNicknameAvailability($_SESSION["connection"], $_POST["username"])
            // Et si les hashs de mots de passe fonctionnent,
        &&  password_verify($_POST["password"], getUserPasswordHash($_SESSION["connection"], $_POST["username"])))
        {
            // Si les hashs de mots de passe concordent, la connection est réussie
            //TODO Valider la connection et rediriger vers l'accueil
        }
        else
        {
            // Si le pseudo n'est pas pris, c'est un mauvais identifiant
            $BAD_CREDENTIALS = true;
        }
    }
    else
    {
      // Si aucun formulaire n'a été envoyé, se contenter d'afficher la page sans erreurs
      $BAD_CREDENTIALS = false;
    }
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

        <!-- Formulaire de connexion -->
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
                                <input class="form-control<?php if ($BAD_CREDENTIALS) echo " is-invalid";?>" type="text" name="username" placeholder="username">
                            </div>
                            <div class="row">
                                <h3>Mot de passe</h3>
                            </div>
                            <div class="row">
                                <input class="form-control<?php if ($BAD_CREDENTIALS) echo " is-invalid";?>" type="password" name="password">
                            </div>
                            <div class="row alert alert-danger" role="alert" <?php if (!$BAD_CREDENTIALS) echo "style=\"display:none\""?> >
                            Les informations de connexion entrées sont éronnées!
                            </div>
                            <div class="row">
                                <input class="form-control" type="submit" value="Se connecter">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin du formulaire de connexion -->

    </body>
</html>