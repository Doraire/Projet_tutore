<?php
	include("../Modeles/membre.php");
	include("../Modeles/bd.php");
	$login = $_POST["login"];
	$mdp = $_POST["mdp"];
	$bd = new bd();
	$co = $bd->connexion();
	$requete = "SELECT numClient, loginClient, mdpClient FROM client WHERE loginClient = '$login' AND mdpClient = '$mdp'";
	$resultat = mysqli_query($co, $requete);
	if(mysqli_num_rows($resultat) == 1){
		$row = mysqli_fetch_assoc($resultat);
		$numclient = $row["numClient"];
		$loginClient = $row["loginClient"];
		$membre = new Membre($co,$numclient,$loginClient);
		$membre->connexion();
		header("Location: ../Vues/html/page_index.php");
	}
	else{
		header("Location: ../Vues/html/page_connexion.php?mdp=nega");
	}
?>
