<?php
session_start();
$num_client = $_SESSION["num_client"];
require_once("../Modeles/bd.php");
$bd = new Bd();
$co = $bd->connexion();

foreach ($_POST as $cle => $valeur) 
{
	if($cle=="prix")
	{
		$prix = $valeur;
	}
	else if($cle=="quantite")
	{
		$quantite = $valeur;
	}
	else
	{
		$nom_produit = $cle;
		$valeur_modif = $valeur;
	}
}

$num_produit = mysqli_query($co, "SELECT numProduit FROM Produit WHERE nomProduit = '$nom_produit'");
$num_produit = mysqli_fetch_assoc($num_produit);
$num_produit = $num_produit["numProduit"];

if($prix) //modification du prix
{
	mysqli_query($co, "UPDATE Produit SET prixProduit=$valeur_modif WHERE numProduit=$num_produit");
}
if($quantite) //modification de la quantite
{
	mysqli_query($co, "UPDATE Produit SET quantiteStock=$valeur_modif WHERE numProduit=$num_produit");
}
header("Location: ../Vues/html/page_stocks.php")
?>