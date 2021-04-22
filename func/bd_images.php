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

function getCategoryByID($link, $id)
{
    return mysqli_fetch_assoc(executeQuery($link, "SELECT * FROM Categorie WHERE catId=$id"));
    
}

?>