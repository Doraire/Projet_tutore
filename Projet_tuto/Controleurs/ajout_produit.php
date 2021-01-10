<?php
require_once("../Modeles/bd.php");
$famille = $_POST["famille"];
$nom = $_POST["nom"];
$type = $_POST["type"];
$image = $_POST["image"];
$quantite = $_POST["quantite"];
$prix = $_POST["prix"];
$bd = new Bd();
$co = $bd->connexion();
$num_famille = mysqli_query($co, "SELECT numFamille FROM Famille WHERE nomFamille='$famille'");
$num_famille = mysqli_fetch_assoc($num_famille);
$num_famille = $num_famille["numFamille"];
$succes = mysqli_query($co, "INSERT INTO Produit VALUES(NULL, '$type', '$nom', $prix, '$quantite', '$image', $num_famille)");
if($succes)
{
	header("Location: ../Vues/html/page_ajout_produits.php?ajout=oui");
}
else
{
	header("Location: ../Vues/html/page_ajout_produits.php?ajout=non");
}

?>