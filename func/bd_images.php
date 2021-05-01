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

function getNextPhotoID($link)
{
    return mysqli_fetch_assoc(
        executeQuery(
            $link,
            "SELECT AUTO_INCREMENT
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = 'images'
            AND   TABLE_NAME   = 'Photo'"
        )
    )["AUTO_INCREMENT"];
}

function addImage($link, $nomFich, $description, $catId, $auteur)
{
    return executeUpdate(
        $link,
        "INSERT INTO Photo (nomFich, description, catId, auteur) VALUES (\"$nomFich\", \"$description\", $catId, \"$auteur\")"
    );
}

function removeImage($link, $id)
{
    return executeUpdate(
        $link,
        "DELETE FROM Photo WHERE Photo.photoId = $id"
    );
}

?>