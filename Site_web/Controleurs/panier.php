<?php
session_start();
$num_client = $_SESSION["num_client"];
require_once("../Modeles/bd.php");
$bd = new Bd();
$co = $bd->connexion();
if($num_client)
{
	$num_client = $_SESSION["num_client"];
	$prix_limite =$_POST["prix_limite"];
	$nb_personnes =$_POST["nb_personnes"];
	$jour = $_POST["jour"];
	mysqli_query($co, "INSERT INTO Panier VALUES(NULL, $prix_limite, $nb_personnes, '$jour')");
	$num_panier = mysqli_insert_id($co);
	mysqli_query($co, "INSERT INTO Commande VALUES(NULL, SYSDATE(), $num_panier, $num_client)");
	header("Location: ../Vues/html/page_accueil.php");
}
else
{
	header("Location: ../Vues/html/page_connexion.php");
}
?>