<?php
session_start();
require_once("../Modeles/bd.php");
$bd = new Bd();
$co = $bd->connexion();
$num_client = $_SESSION["num_client"];
foreach ($_POST as $clef => $valeur) 
{
	if($valeur!="")
	{
		if($clef!="quartier")
		{
			mysqli_query($co, "UPDATE client SET ".$clef."Client = '".$valeur."' WHERE numClient = $num_client");
		}
		else
		{
			$nb_quartier = mysqli_query($co, "SELECT COUNT(*) AS nb FROM Quartier WHERE nomQuartier='$valeur'");
			$nb_quartier = mysqli_fetch_assoc($nb_quartier);
			$nb_quartier = $nb_quartier["nb"];
			if($nb_quartier>0)
			{
				$quartier = mysqli_query($co, "SELECT numQuartier FROM Quartier WHERE nomQuartier='$valeur'");
				$quartier = mysqli_fetch_assoc($quartier);
				$quartier = $quartier["numQuartier"];
				mysqli_query($co, "UPDATE client SET numQuartier = $quartier WHERE numClient = $num_client");
			}
			else
			{
				mysqli_query($co, "INSERT INTO Quartier VALUES(NULL,'$valeur');");
				$quartier = mysqli_insert_id($co);
				mysqli_query($co, "UPDATE client SET numQuartier = $quartier WHERE numClient = $num_client");
			}
		}
	}	
}
header("Location: ../Vues/html/page_modif_client.php");
?>