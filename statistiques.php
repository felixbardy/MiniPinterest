<?php
  session_start();
  require_once("./func/bd.php");
  require_once("./func/bd_images.php");
  require_once("./func/bd_users.php");
  require_once("./func/interface_generation.php");
  $_SESSION["connection"] = getConnection("localhost", "root", "", "images");

  // Si l'utilisateur n'est pas administrateur, il n'a rien à faire là
  if (!isset($_SESSION["admin"]) || !$_SESSION["admin"])
  {
      header("Location: ./index.php");
      exit;
  }

?>

<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Projet BDW1 2021</title>
    <link rel="stylesheet" href="./lib/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">

    <script src="./lib/js/jquery-3.3.1.min.js"></script>
    <script src="./lib/js/popper.min.js"></script>
    <script src="./lib/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php 
  echo generatePageHeader("Statistiques");
  ?>
  <div class="container">
    <h1 class="title">Statistiques</h1>
    <div class="row">
      <div class="col-12">
        <table class="table table-bordered text-center stats-table">
          <thead>
            <th>Nombre d'images</th>
            <th>Nombre de catégories</th>
            <th>Nombre d'utilisateurs</th>
          </thead>
          <tbody>
            <td><?php echo imageCount($_SESSION["connection"]) ?></td>
            <td><?php echo categoryCount($_SESSION["connection"]) ?></td>
            <td><?php echo userCount($_SESSION["connection"]) ?></td>
          </tbody>
        </table>
      </div> <!-- column -->
    </div> <!-- row --> 
    <div class="row">
      <div class="col-6">
        <table class="table table-bordered text-center stats-table">
          <?php
            $counts = imageCountPerCategory($_SESSION["connection"]);
          ?>
          <thead>
            <th>catId</th>
            <th>Catégorie</th>
            <th>Images</th>
            <th>Cachées</th>
          </thead>
          <tbody>
            <?php
            foreach($counts as $row)
            {
            ?>
            <tr>
              <td><?php echo $row["catId"] ?></td>
              <td><?php echo "<a href=\"./index.php?category=" . $row["catId"] ."\">" . $row["nomCat"] . "</a>" ?></td>
              <td><?php echo $row["total"] ?></td>
              <td><?php echo $row["hidden"] ?></td>
            </tr>
            <?php
            } // Fin foreach($counts as $row)
            ?>
          </tbody>
        </table>
      </div> <!-- column -->
      <div class="col-6">
        <table class="table table-bordered text-center stats-table">
          <?php
            $counts = imageCountPerUser($_SESSION["connection"]);
          ?>
          <thead>
            <th>User</th>
            <th>Images</th>
            <th>Cachées</th>
          </thead>
          <tbody>
            <?php
            foreach($counts as $row)
            {
            ?>
            <tr>
              <td><?php echo "<a href=\"./mes_images.php?user=" . urlencode($row["pseudo"]) . "\">" . $row["pseudo"] . "</a>" ?></td>
              <td><?php echo $row["total"] ?></td>
              <td><?php echo $row["hidden"] ?></td>
            </tr>
            <?php
            } // Fin foreach($counts as $row)
            ?>
          </tbody>
        </table>
      </div> <!-- colomn -->
    </div> <!-- row -->
  </div> <!-- container -->
  </body>
</html>