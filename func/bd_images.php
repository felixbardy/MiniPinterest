<?php

require_once("./func/bd.php");

function getAllCategories($link)
{
    return mysqli_fetch_all(
        executeQuery($link, "SELECT * FROM Categorie"),
        MYSQLI_ASSOC
    );
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
    return mysqli_fetch_assoc(executeQuery($link, "SELECT * FROM Photo WHERE photoId=$id"));
}

function getCategoryByID($link, $id)
{
    return mysqli_fetch_assoc(executeQuery($link, "SELECT * FROM Categorie WHERE catId=$id"));
    
}

?>