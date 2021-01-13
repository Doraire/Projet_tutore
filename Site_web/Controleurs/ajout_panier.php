<?php 
	session_start();
	include("../Modeles/bd.php");
	$bd = new Bd();
	$co = $bd->connexion();

	$numcommande = $_GET["numcom"];
	$resultatpanier=mysqli_query($co,"SELECT numPanier FROM Panier P, Commande C WHERE C.numcommande=$numcommande and P.numPanier = C.panierCommande");
	$rowpanier=mysqli_fetch_assoc($resultatpanier);
	$numpanier = $rowpanier["numPanier"];
	//pour chaque produit dans le panier
		for($i=0;$i<count($_SESSION['panier']['nomProduit']);$i++){
			$flag = 0;
			//on regarde si c'est déjà dans la base de donné pour savoir si on update ou on insert
			$resultat = mysqli_query($co,"SELECT numProduit FROM Produit WHERE nomProduit ='".$_SESSION['panier']['nomProduit'][$i]."'");
			$row=mysqli_fetch_assoc($resultat);
			$numproduit = $row["numProduit"];


			$resultat2=mysqli_query($co,"SELECT numProduit,quantiteProduit FROM compopanier WHERE numPanier = $numpanier");
			while($row2=mysqli_fetch_assoc($resultat2)){
				if($row2["numProduit"]==$numproduit){
					$flag=1;
				}
			}

			if($_SESSION['panier']['qteProduit'][$i]==0){
				$flag=2;
			}
			//si ce n'est pas dans la base donnée alors on insert
			if($flag==0){
				mysqli_query($co,"INSERT INTO compopanier VALUES($numpanier,$numproduit,".$_SESSION['panier']['qteProduit'][$i].")");
			}
			elseif($flag==1){
				mysqli_query($co,"UPDATE compopanier SET quantiteProduit = ".$_SESSION['panier']['qteProduit'][$i]." WHERE numProduit=$numproduit AND numPanier = $numpanier");
				
			}
			else{
				mysqli_query($co,"DELETE FROM compopanier WHERE numProduit=$numproduit AND numPanier = $numpanier");
				
			}
		}
	
	$_SESSION['panier']=array();
    $_SESSION['panier']['nomProduit'] = array();
    $_SESSION['panier']['qteProduit'] = array();

	header("Location: ../Vues/html/page_commande.php?optadm=1");
?>
