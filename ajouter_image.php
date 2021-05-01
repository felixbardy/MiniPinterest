<?php
    session_start();
    require_once("./func/bd_images.php");
    require_once("./func/interface_generation.php");
    require_once("./func/bd_users.php");
    $_SESSION["connection"] = getConnection("localhost", "root", "", "images");

    // Si l'utilisateur n'est pas connecté,
    // le rediriger vers la page de connection
    if (!isset($_SESSION["logged"]) || !$_SESSION["logged"])
    {
      header("Location: ./connexion.php");
      exit;
    }

    $formErrors = [];
    if (!empty($_POST))
    {
      if (!isset($_FILES["image"])) {
        $formErrors["noFile"] = true;
      }
      $file_type = strtolower( pathinfo( basename( $_FILES["image"]["name"] ), PATHINFO_EXTENSION ) );
      $valid_types = ["jpg", "jpeg", "gif", "png"];


      if (!in_array($file_type, $valid_types))
        $formErrors["invalidType"] = true;

      if ($_POST["description"] == "")
        $formErrors["descriptionEmpty"] = true;
      
      if ($_POST["category"] == "none")
        $formErrors["noCategory"] = true;
      
      
      //TODO Si aucune erreur n'est trouvée, valider
      if (empty($formErrors))
      {
        $target_dir = "./img/";
        $photoId = getNextPhotoID($_SESSION["connection"]);
        $target_file = "DSC" . strval($photoId) . ".$file_type";

        addImage(
          $_SESSION["connection"],
          $target_file,
          $_POST["description"],
          $_POST["category"],
          $_SESSION["username"]
        );

        move_uploaded_file(
          $_FILES["image"]["tmp_name"],
          $target_dir . $target_file
        );

        header("Location: ./photo_details.php?photoId=$photoId");
        exit;
      }
    }
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>
      Ajouter une image
    </title>
    <link rel="stylesheet" href="./lib/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./style/style.css" />

    <script src="./lib/js/jquery-3.3.1.min.js"></script>
    <script src="./lib/js/popper.min.js"></script>
    <script src="./lib/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php echo generatePageHeader("Ajouter_image"); ?>

    <!-- Formulaire d'inscription -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 offset-md-4">
          <h1 align="center"><b>Ajouter une image</b></h1>
          <form name="add_image" action="" method="POST" enctype="multipart/form-data">


            <h4><b>Fichier</b></h4>
            <div class="input-group mb-3">
              <div class="custom-file">
                <input
                  id="image-input"
                  type="file"
                  class="custom-file-input"
                  name="image"
                />
                <label class="custom-file-label" for="inputGroupFile01">
                  Choisir un fichier
                </label>
              </div>
            
            </div>

            <?php
              if (isset($formErrors["noFile"]))
                echo generateError("Aucune image n'a été fournie!")
            ?>

            <?php
              if(isset($formErrors["invalidType"]))
                echo generateError("Seuls les fichiers d'extension '.jpg', '.png' et '.gif' sont acceptés!");
            ?>

            <h4><b>Description</b></h4>
            <div class="input-group mb-3">
              <textarea
                class="form-control"
                name="description"
                placeholder="Description de l'image"  
              ><?php
                if (isset($_POST["description"])) 
                  echo $_POST["description"]
              ?></textarea>

            </div>

            <?php
              if(isset($formErrors["descriptionEmpty"]))
                echo generateError("La description est obligatoire!");
            ?>

            <div class="input-group mb-3">

              <select class="form-control" name="category">
                <option value="none">Choisir une catégorie...</option>
                <?php
                $categories = getAllCategories($_SESSION["connection"]);
                foreach($categories as $category) {
                  echo "<option value=" . strval($category["catId"]);
                  if (isset($_POST["category"]) && $_POST["category"] == $category["catId"])
                    echo " selected";
                  echo ">" . $category["nomCat"] . "</option>\n";
                }
                ?>
              </select>

            </div>

            <?php
              if(isset($formErrors["noCategory"]))
                echo generateError("Vous DEVEZ indiquer une catégorie!");
            ?>

            <div class="input-group mb-3">
              <input
                class="form-control btn-primary"
                type="submit"
                value="Enregistrer"
              >
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
  <!-- Petit script pour mettre à jour le champ d'input à l'ajout d'un fichier -->
  <script language="JavaScript">
    const img_in = document.getElementById("image-input");
    const max_size = 100000; //100 kB
    img_in.oninput = () => {
      let file = img_in.files[0];
      if (file.size > max_size) { // Si le fichier est trop gros:
        alert("Le fichier est trop volumineux! (max: 100ko)"); // On envoie un pop-up d'erreur
        img_in.value = null; // On vide le champ
      }
      else { // Sinon on affiche le nom du fichier dans le champ
        img_in.nextElementSibling.innerHTML = file.name;
      }
    }
    

  </script>
</html>
