<?php 
	session_start();
	include("../Modeles/bd.php");
	$bd = new Bd();
	$co = $bd->connexion();

	mysqli_query($co,"INSERT INTO Commande VALUES (NULL,SYSDATE(),NULL,".$_SESSION['num_client'].")");

	$numcommande = mysqli_insert_id($co);
	for($i=0;$i<count($_SESSION['panier']['nomProduit']);$i++){
		$resultat = mysqli_query($co,"SELECT numProduit FROM Produit WHERE nomProduit ='".$_SESSION['panier']['nomProduit'][$i]."'");
		$row = mysqli_fetch_assoc($resultat);
		mysqli_query($co,"INSERT INTO ensembleproduits VALUES($numcommande,".$row['numProduit'].",".$_SESSION['panier']['qteProduit'][$i].")");
	}	



	header("Location: ../Vues/html/page_choix_livraison.php");
?>

