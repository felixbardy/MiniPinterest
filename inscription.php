<?php
    session_start();
    require_once("./func/bd_images.php");
    require_once("./func/interface_generation.php");
    require_once("./func/bd_users.php");
    $_SESSION["connection"] = getConnection("localhost", "root", "", "images");

    if (isset($_SESSION["logged"]) && $_SESSION["logged"])
    {
      header("Location: ./index.php");
      exit;
    }

    $formErrors = [];
    
    // Si le formulaire d'inscription a été envoyé
    if (!empty($_POST))
    {
      //Si le nom d'utilisateur est vide, ajouter l'erreur
      if ($_POST["username"] == "")
        $formErrors["nameEmpty"] = true;

      // Si le nom d'utilisateur n'est pas disponible, ajouter l'erreur
      if (!checkNicknameAvailability($_SESSION["connection"], $_POST["username"]))
        $formErrors["nameTaken"] = true;

      // Si le mot de passe est pas vide, ajouter l'erreur
      if ($_POST["password"] == "")
        $formErrors["passwordEmpty"] = true;
      
      // Si la confirmation est différente, ajouter l'erreur
      if ($_POST["password"] != $_POST["repeat_password"])
        $formErrors["wrongValidation"] = true;
      
      // Si aucune erreur n'a été détéctée, valider et créer le compte et connecter l'utilisateur
      if (empty($formErrors))
      {
        //TODO valider et créer le compte, connecter l'utilisateur et rediriger vers l'accueil
        echo "<p>";
        echo "Inscription réussie!\n";
        echo "username: " . $_POST["username"] . "\n";
        echo "password: " . $_POST["password"] . "\n";
        echo "password_validation: " . $_POST["repeat_password"] . "\n";
        echo "</p>";

        if (!createAccount($_SESSION["connection"], $_POST["username"], $_POST["password"]))
        {
          $formErrors["couldNotCreateAccount"] = true;
        }
        else
        {
          $_SESSION["logged"] = true;
          $_SESSION["username"] = $_POST["username"];
          header("Location: ./index.php");
          exit;
        }
        
      }
    }
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            Inscription
        </title>
        <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
        <link rel="stylesheet" href="./style/style.css">

        <script src="./lib/js/jquery-3.3.1.min.js"></script>
        <script src="./lib/js/popper.min.js"></script>
        <script src="./lib/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php echo generatePageHeader("Inscription"); ?>

        <!-- Formulaire d'inscription -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 offset-md-5">
                    <h1><b>Inscription</b></h1>
                    <form name="sign_in" action="" method="POST">
                        <div class="input-group">

                            <div class="row">
                                <h3>Identifiant</h3>
                            </div>
                            <div class="row">
                                <input class="form-control
                                <?php if (isset($formErrors["nameTaken"]) || isset($formErrors["nameEmpty"])) echo " is-invalid";?>" type="text" name="username" placeholder="username">
                            </div>

                            <div class="row alert alert-danger" role="alert" <?php if (!isset($formErrors["nameTaken"])) echo "style=\"display:none\""?> >
                            Cet identifiant est déjà utilisé!
                            </div>

                            <div class="row alert alert-danger" role="alert" <?php if (!isset($formErrors["nameEmpty"])) echo "style=\"display:none\""?> >
                            Le nom d'utilisateur ne peut pas être vide!
                            </div>

                            <div class="row">
                                <h3>Mot de passe</h3>
                            </div>
                            <div class="row">
                                <input class="form-control<?php if (isset($formErrors["passwordEmpty"])) echo " is-invalid";?>" type="password" name="password">
                            </div>

                            <div class="row alert alert-danger" role="alert" <?php if (!isset($formErrors["passwordEmpty"])) echo "style=\"display:none\""?> >
                            Veuillez entrer un mot de passe!
                            </div>

                            <div class="row">
                                <h3>Confirmer mot de passe</h3>
                            </div>
                            <div class="row">
                                <input class="form-control<?php if (isset($formErrors["wrongValidation"])) echo " is-invalid";?>" type="password" name="repeat_password">
                            </div>

                            <div class="row alert alert-danger" role="alert" <?php if (!isset($formErrors["wrongValidation"])) echo "style=\"display:none\""?> >
                            Les mots de passes ne correspondent pas!
                            </div>

                            <div class="row">
                                <input class="form-control" type="submit" value="Se connecter">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Fin du formulaire d'inscription -->
    </body>
</html>