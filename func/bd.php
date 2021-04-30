<?php

$dbHost = "http://localhost/phpmyadmin/";// à compléter
$dbUser = "root";// à compléter
$dbPwd = "";// à compléter
$dbName = "images";

/*Cette fonction prend en entrée l'identifiant de la machine hôte de la base de données, les identifiants (login, mot de passe) d'un utilisateur autorisé 
sur la base de données contenant les tables pour le chat et renvoie une connexion active sur cette base de donnée. Sinon, un message d'erreur est affiché.*/
function getConnection($dbHost, $dbUser, $dbPwd, $dbName)
{
	$bd_connection = mysqli_connect($dbHost,$dbUser,$dbPwd,$dbName);

	if ( mysqli_connect_errno() )
		printf("Échec de la connexion: %s", mysqli_connect_error());
	else
		return $bd_connection;
}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL SELECT et renvoie les résultats de la requête. Si le résultat est faux, un message d'erreur est affiché*/
function executeQuery($link, $query)
{
	if ( strpos($query, 'SELECT') != 0 )
	{
		printf("La requête '%s' n'est pas une séléction! Pour des modifications, utilisez executeUpdate(...).", $query);
		return FALSE;
	}

	$result = mysqli_query($link,$query);

	return $result;
}

/*Cette fonction prend en entrée une connexion vers la base de données du chat ainsi 
qu'une requête SQL INSERT/UPDATE/DELETE et ne renvoie rien si la mise à jour a fonctionné, sinon un 
message d'erreur est affiché.*/
function executeUpdate($link, $query)
{
	if 
	( 	// Si il n'y a aucun de ces mots clé en début de requête
		   strpos($query, 'INSERT') != 0 
		&& strpos($query, 'UPDATE') != 0 
	  	&& strpos($query, 'DELETE') != 0
	)
	{
		printf("La requête '%s' n'est pas une modification! Pour des sélections, utilisez executeQuery(...).", $query);
		return FALSE;
	}

	$result = mysqli_query($link,$query);

	return $result;
}

/*Cette fonction ferme la connexion active $link passée en entrée*/
function closeConnexion($link)
{
	// à compléter
}
?>