<?php
	include("../Modeles/bd.php");
	$bd = new Bd();
	$co = $bd->connexion();


	$nom=$_POST["nom"];
	$prenom=$_POST["prenom"];
	$mail=$_POST["mail"];
	$adresse=$_POST["adresse"];
	$quartier=$_POST["quartier"];
	$login=$_POST["login"];
	$mdp=$_POST["mdp"];

	//On vérifie si d'autre utilisateur ont le même login

	$resultat = mysqli_query($co,"SELECT loginClient FROM Client WHERE loginClient = '$login'");

	if(mysqli_num_rows($resultat)>=1){
		header("Location: ../Vues/html/page_inscription.php?login=nega");
	}
	else{
	//On cherche le quartier ou on l'ajoute

		$resultat = mysqli_query($co,"SELECT numQuartier,nomQuartier FROM Quartier WHERE nomQuartier = '$quartier'");
		if(mysqli_num_rows($resultat)==1){
			$row=mysqli_fetch_assoc($resultat);
			$numquartier = $row["numQuartier"];
		}
		else{
			mysqli_query($co,"INSERT INTO Quartier VALUES(NULL,'$quartier')");
			$numquartier = mysqli_insert_id($co);
		}

	//Insertion dans la base de donnée du client

		mysqli_query($co,"INSERT INTO Client VALUES(NULL,'$nom','$prenom','$mail','$login','$mdp','$adresse',$numquartier)"); 

	//On renvoie sur la page de connexion après l'inscription

		header("Location: ../Vues/html/page_connexion.php");
	}
?>
