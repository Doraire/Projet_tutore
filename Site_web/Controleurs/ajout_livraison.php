<?php
include("../Modeles/bd.php");
$bd = new Bd();
$co = $bd->connexion();

if(isset($_POST['datelivraison'])){
	$new_date = date('Y-m-d', strtotime($_POST['datelivraison']));
	if($new_date!='1970-01-01'){
		$numcommande = $_POST["numcommande"];
		mysqli_query($co,"INSERT INTO Livraison VALUES (NULL,'$new_date',0)");
		$id = mysqli_insert_id($co);
		mysqli_query($co,"INSERT INTO commande_livraison VALUES($numcommande,$id)");
	}
	
}

header("Location: ../Vues/html/page_commande.php?optadm=1");

?>