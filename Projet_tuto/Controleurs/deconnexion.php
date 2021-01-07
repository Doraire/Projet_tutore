<?php
	include("../Modeles/membre.php");
	include("../Modeles/bd.php");
	session_start();
	$numClient = $_SESSION['numclient'];
	$login = $_SESSION['login'];
	$bd = new Bd();
	$co = $bd->connexion();
	$membre = new membre($co,$numclient,$login);
	$membre->deconnexion();
	header("Location: ../Vues/html/page_connexion.php");
	
?>