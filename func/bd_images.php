<?php

require_once("./func/bd.php");

function getAllCategories($link)
{
    return executeQuery($link, "SELECT * FROM Categorie");
}

function getAllImages($link)
{
    return mysqli_fetch_all(
        executeQuery($link, "SELECT * FROM Photo"),
        MYSQLI_ASSOC
    );
}

function getImagesFromCategoryID($link, $catId)
{
    return mysqli_fetch_all(
        executeQuery($link, "SELECT * FROM Photo WHERE catId=$catId"),
        MYSQLI_ASSOC
    );
}

function getImageByID($link, $id)
{
    $result = executeQuery($link, "SELECT * FROM Photo WHERE photoId=$id");
    return $result;
}

function getCategoryNameByID($link, $id)
{
    $result = executeQuery($link, "SELECT nomCat FROM Categorie WHERE catId=$id");
    foreach($result as $key => $category)
      foreach($category as $key => $value)
          return $value;
}

?>