<?php

require_once("./func/bd.php");

function checkNicknameAvailability($link, $pseudo)
{
    $result = mysqli_fetch_assoc( executeQuery($link, "SELECT pseudo FROM User WHERE pseudo = '$pseudo'") );
    return $result == null;
}

function checkUserPassword($link, $pseudo, $pwd)
{
    $result = mysqli_fetch_assoc(
        executeQuery($link, "SELECT passwordHash FROM User WHERE pseudo = '$pseudo'")
    );
    return password_verify($pwd, $result["passwordHash"]);
}

function isUserAdmin($link, $pseudo)
{
    return mysqli_fetch_assoc( 
            executeQuery(
            $link,
            "SELECT admin FROM User WHERE pseudo=\"$pseudo\""
        )
    )["admin"];
}

function createAccount($link, $pseudo, $pwd)
{
    $hash = password_hash($pwd,PASSWORD_DEFAULT);
    
    return executeUpdate(
        $link,
        "INSERT INTO User (pseudo, passwordHash) VALUES ('$pseudo', '$hash')"
    );
}

?>