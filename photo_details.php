<?php
    session_start();
    require_once("./func/bd_images.php");
    require_once("./func/interface_generation.php");
    $_SESSION["connection"] = getConnection("localhost", "root", "", "images");

    function canModifyPhoto($photo)
    {
      return isset($_SESSION["admin"]) && $_SESSION["admin"]
          || isset($_SESSION["username"]) && $photo["auteur"] == $_SESSION["username"];
    }

    // Si l'identifiant de photo n'existe pas ou n'a pas été donné, renvoyer vers l'accueil
    if (empty($_GET) || is_null($_GET["photoId"]))
    {
        header("Location: ./index.php");
        exit;
    }

    $photo = getImageByID($_SESSION["connection"], $_GET["photoId"]);
    $category = getCategoryByID($_SESSION["connection"],$photo["catId"]);
    
    // Si la photo est cachée et que l'utilisateur
    // n'est ni admin ni son auteur, rediriger vers l'accueil
    if (
      $photo["hidden"]
      && !( $_SESSION["admin"] || $_SESSION["username"] == $photo["auteur"] )
      )
    {
      header("Location: ./index.php");
      exit;
    }

    $formErrors = [];

    

    if (!empty($_POST) && $_POST["form-name"] == "delete-photo")
    {
      // Les droits pourraient être modifiés entre l'accès à la page et l'envoi du formulaire
      if (!canModifyPhoto($photo))
        $formErrors["notAuthorized"] = true;

      // S'il n'y a pas d'erreurs, supprimer l'image
      if (empty($formErrors))
      {
        removeImage($_SESSION["connection"], $photo["photoId"]);
        unlink("./img/" . $photo["nomFich"]);

        //TODO Rediriger vers "mes_photos.php" à la place
        header("Location: ./index.php");
        exit;
      }
    }
    else if (!empty($_POST) && $_POST["form-name"] == "edit-image")
    {
      // Les droits pourraient être modifiés entre l'accès à la page et l'envoi du formulaire
      if (!canModifyPhoto($photo))
        $formErrors["notAuthorized"] = true;
      
      // La description ne peut pas être vide
      if ($_POST["description"] == "")
        $formErrors["descriptionEmpty"] = true;

      // S'il n'y a pas d'erreurs, modifier l'image
      if (empty($formErrors))
      {
        if (isset($_POST["hidden"])) $isHidden = 1;
        else $isHidden = 0;
        
        editImage(
          $_SESSION["connection"],
          $photo["photoId"],
          $_POST["description"],
          $_POST["category"],
          $isHidden
        );
        
        // On remet l'image à jour après sa modification
        $photo = getImageByID(
          $_SESSION["connection"],
          $_GET["photoId"]
        );
      }
    }    

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo "Photo n°" . $photo["photoId"]; ?>
        </title>
        <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
        <link rel="stylesheet" href="./style/style.css">

        <script src="./lib/js/jquery-3.3.1.min.js"></script>
        <script src="./lib/js/popper.min.js"></script>
        <script src="./lib/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php echo generatePageHeader(null); ?>

        <?php
          if(isset($formErrors["notAuthorized"]))
            echo generateError("Vous n'êtes pas autorisé à modifier cette image!");
        ?>
        <div class="container">
          <h1><b><?php echo "Détails sur " . $photo["nomFich"] . " (id=" . $photo["photoId"] . "):"; ?></b></h1>
          <div class="row">
              <div class="col-md">
                  <?php echo "<img class=\"img-responsive\" src=\"img/" . $photo["nomFich"] . "\">"; ?>
              </div>
              <div class="col-md">
                  <?php 
                  echo generateImageDetails($photo, $category);

                  if(!empty($formErrors))
                    echo generateError("Une erreur est survenue lors de la modification!");

                  if ( canModifyPhoto($photo) ) {
                    echo generateImageModifButton();
                  }
                  ?>
              </div>
          </div>
        </div> <!-- container -->
        <?php if ( canModifyPhoto($photo) ) { ?>

        <div class="modal fade" id="editModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modifier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h1 align="center"><b>Modifier l'image</b></h1>
                <form id="form-edit-image" name="edit-image" action="" method="POST">
                  <input type="hidden" name="form-name" value="edit-image" />

                  <h4><b>Description</b></h4>
                  <div class="input-group mb-3">
                    <textarea
                      class="form-control"
                      name="description"
                      placeholder="Description de l'image"  
                    ><?php
                      echo $photo["description"];
                    ?></textarea>
                  </div>

                  <?php
                    if(isset($formErrors["descriptionEmpty"]))
                      echo generateError("La description ne peut pas être vide!");
                  ?>

                  <h4><b>Catégorie</b></h4>
                  <div class="input-group mb-3">

                    <select class="form-control" name="category">
                      <?php
                      $categories = getAllCategories($_SESSION["connection"]);
                      foreach($categories as $category) {
                        echo "<option value=" . strval($category["catId"]);
                        if ($photo["catId"] == $category["catId"])
                          echo " selected";
                        echo ">" . $category["nomCat"] . "</option>\n";
                      }
                      ?>
                    </select>

                  </div>

                  <div class="custom-control custom-switch">
                      <input 
                        type="checkbox"
                        class="custom-control-input"
                        name="hidden"
                        value="yes"
                        id="input-photo-hidden"
                        <?php if ($photo["hidden"]) echo "checked" ?>
                      >
                      <label class="custom-control-label" for="input-photo-hidden">Cachée</label>
                    </div>
                  </form>
              </div> <!-- modal-body -->
              <div class="modal-footer">
                <button type="button" class="btn btn-danger mr-auto" data-toggle="modal" data-target="#deleteModal">
                  Supprimer
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                <button form="form-edit-image" type="submit" class="btn btn-success">Valider</button>
              </div>
            </div> <!-- modal-content -->
          </div> <!-- modal-dialog -->
        </div> <!-- modal -->

        <div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Supprimer?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Voulez vous vraiment supprimer cette photo?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-auto" data-dismiss="modal">Annuler</button>
                <form name="delete-photo" action="" method="POST">
                  <input type="hidden" name="form-name" value="delete-photo" />
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                </form>
              </div>
            </div> <!-- modal-content -->
          </div> <!-- modal-dialog -->
        </div> <!-- modal -->
        <?php } // End of "if (user == author)" ?>
        <div class="row" height=2000px>
        </div>
    </body>
</html>