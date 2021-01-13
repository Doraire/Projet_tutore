<?php
	session_start();
	include("../Modeles/bd.php");
	$bd = new Bd();
	$co = $bd->connexion();
	$numcommande=$_GET["numcom"];

	
    $_SESSION['panier']=array();
    $_SESSION['panier']['nomProduit'] = array();
    $_SESSION['panier']['qteProduit'] = array();
    

	$resultat=mysqli_query($co,"SELECT numProduit,quantiteProduit FROM ensembleproduits WHERE numCommande=$numcommande");
	//On initialise l'array de panier pour l'utiliser dans page_produits ou l'utilisateur va faire ses modifications
	while($row=mysqli_fetch_assoc($resultat)){
		$numproduit = $row["numProduit"];
		$qteproduit = $row["quantiteProduit"];
		
		$resultat2=mysqli_query($co,"SELECT nomProduit FROM produit WHERE numProduit = $numproduit");
		$row2=mysqli_fetch_assoc($resultat2);
		$nomproduit = $row2["nomProduit"];	
		
		array_push($_SESSION['panier']['nomProduit'],$nomproduit);
        array_push($_SESSION['panier']['qteProduit'],$qteproduit);
	}


	header("Location: ../Vues/html/page_produits.php?numcom=$numcommande");
?>