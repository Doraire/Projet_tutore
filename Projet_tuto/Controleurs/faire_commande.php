<?php
$choix = $_POST["choix"];
if($choix=="ponctuel")
{
	header("Location: ../Vues/html/page_produits.php");
}
else
{
	header("Location: ../Vues/html/page_panier.php");
}
?>