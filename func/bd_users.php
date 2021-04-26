<?php

require_once("./func/bd.php");

function checkNicknameAvailability($link, $pseudo)
{
    $result = executeQuery($link, "SELECT pseudo FROM User WHERE pseudo = $pseudo");
    return !boolval($result);
}

function getUserPasswordHash($link, $pseudo)
{
    $result = mysqli_fetch_assoc(
        executeQuery($link, "SELECT passwordHash FROM User WHERE pseudo = $pseudo")
    );
    return $result["passwordHash"];
}

?>