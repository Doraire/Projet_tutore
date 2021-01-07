<?php
	include("../Modeles/membre.php");
	include("../Modeles/bd.php");
	$login = $_POST["login"];
	$mdp = $_POST["mdp"];
	echo "$login $mdp ohhoho";
	$bd = new bd("projet_tuto");
	echo "héhéhé";
	//$co = $bd->connexion();
	//$requete = "SELECT numClient, loginClient, mdpClient FROM client WHERE loginClient = $login AND mdpClient = $mdp";
	//$resultat = mysqli_query($co, $result);
	echo "héhéhé";
?>