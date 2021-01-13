<?php
	session_start();

	if(isset($_SESSION["login"]))
	{
		include("../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		$numcommande = $_GET["numcom"];

		//On vérifie que ce soit pas un inconnu qui supprime
		$resultat = mysqli_query($co,"SELECT numCommande,numClient FROM Commande WHERE numCommande = $numcommande AND numClient =".$_SESSION["num_client"]."");
		if(mysqli_num_rows($resultat)==1){	
		//Supression dans ensembleproduit
			mysqli_query($co,"DELETE FROM ensembleproduits WHERE numCommande=$numcommande");
			//echo "DELETE FROM ensembleproduits WHERE numCommande=$numcommande <br>";
		//Supression dans commande
			mysqli_query($co,"DELETE FROM Commande WHERE numCommande=$numcommande");
			//echo "DELETE FROM Commande WHERE numCommande=$numcommande";
		}
	}
	
	header("Location: ../Vues/html/page_commande.php");

?>