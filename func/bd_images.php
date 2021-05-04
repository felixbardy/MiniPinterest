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

function getAllVisibleImages($link)
{
    return mysqli_fetch_all(
        executeQuery($link, "SELECT * FROM Photo WHERE hidden = 0"),
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

function getVisibleImagesFromCategoryID($link, $catId)
{
    return mysqli_fetch_all(
        executeQuery($link, "SELECT * FROM Photo WHERE catId=$catId AND hidden = 0"),
        MYSQLI_ASSOC
    );
}

function getImagesFromUser($link, $pseudo)
{
    return mysqli_fetch_all(
        executeQuery($link, "SELECT * FROM Photo WHERE auteur=\"$pseudo\""),
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

function editImage($link, $id, $description, $catId, $hidden)
{
    return executeUpdate(
        $link,
        "UPDATE Photo SET description = \"$description\", catId = \"$catId\", hidden = $hidden WHERE Photo.photoId = $id"
    );
}

function removeImage($link, $id)
{
    return executeUpdate(
        $link,
        "DELETE FROM Photo WHERE Photo.photoId = $id"
    );
}

function imageCount($link)
{
    return mysqli_fetch_assoc(
        executeQuery(
            $link,
            "SELECT COUNT(*) AS total FROM Photo"
        )
    )["total"];
}

function categoryCount($link)
{
    return mysqli_fetch_assoc(
        executeQuery(
            $link,
            "SELECT COUNT(*) AS total FROM Categorie"
        )
    )["total"];
}

function imageCountPerCategory($link)
{
    $counts = mysqli_fetch_all(
        executeQuery(
            $link,
            "SELECT Categorie.nomCat, Categorie.catId, " .
            "COUNT(DISTINCT Photo.photoId) AS total, SUM(Photo.hidden=1) AS hidden " .
            "FROM Categorie JOIN Photo ON Categorie.catId = Photo.catId " .
            "GROUP BY Photo.catId",
        ),
        MYSQLI_ASSOC
    );

    //FIXME Trouver un moyen de le faire dans la requête
    // Correction du résultat final pour inclure les catégories éliminés par 'JOIN ON'
    $categories = getAllCategories($link);
    foreach($categories as $category)
    {
        $hasImages = false;
        foreach($counts as $count)
            if ($category["catId"] == $count["catId"]) $hasImages = true;
        
        if (!$hasImages) $counts[] = array(
            "nomCat" => $category["nomCat"],
            "catId" => $category["catId"],
            "total" => "0",
            "hidden" => "0"
        );
    }

    return $counts;
}

function imageCountPerUser($link)
{
    $counts = mysqli_fetch_all(
        executeQuery(
            $link,
            "SELECT User.pseudo, COUNT(DISTINCT Photo.photoId) AS total, " .
            "SUM(Photo.hidden=1) as hidden " .
            "FROM User JOIN Photo ON User.pseudo = Photo.auteur GROUP BY User.pseudo "
        ),
        MYSQLI_ASSOC
    );

    //FIXME Trouver un moyen de le faire dans la requête
    // Correction du résultat final pour inclure les utilisateurs éliminés par 'JOIN ON'
    $usernames = getAllUsernames($link);
    foreach($usernames as $username) {
        $hasImages = false;
        foreach($counts as $count)
            if ($username == $count["pseudo"]) $hasImages = true;
        
        if (!$hasImages) $counts[] = array(
            "pseudo" => $username,
            "total" => "0",
            "hidden" => "0"
        );
    }

    return $counts;
}

?>