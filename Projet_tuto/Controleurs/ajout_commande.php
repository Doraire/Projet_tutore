<?php 
	session_start();
	include("../Modeles/bd.php");
	$bd = new Bd();
	$co = $bd->connexion();

	$numcommande = $_GET["numcom"];
	if(empty($numcommande)){
		mysqli_query($co,"INSERT INTO Commande VALUES (NULL,SYSDATE(),NULL,".$_SESSION['num_client'].")");

		$numcommande = mysqli_insert_id($co);
		for($i=0;$i<count($_SESSION['panier']['nomProduit']);$i++){
			$resultat = mysqli_query($co,"SELECT numProduit FROM Produit WHERE nomProduit ='".$_SESSION['panier']['nomProduit'][$i]."'");
			$row = mysqli_fetch_assoc($resultat);
			mysqli_query($co,"INSERT INTO ensembleproduits VALUES($numcommande,".$row['numProduit'].",".$_SESSION['panier']['qteProduit'][$i].")");
		}	

	}
	else{

		//pour chaque produit dans le panier
		for($i=0;$i<count($_SESSION['panier']['nomProduit']);$i++){
			$flag = 0;
			//on regarde si c'est déjà dans la base de donné pour savoir si on update ou on insert
			$resultat = mysqli_query($co,"SELECT numProduit FROM Produit WHERE nomProduit ='".$_SESSION['panier']['nomProduit'][$i]."'");
			$row=mysqli_fetch_assoc($resultat);
			$numproduit = $row["numProduit"];


			$resultat2=mysqli_query($co,"SELECT numProduit,quantiteProduit FROM ensembleproduits WHERE numCommande = $numcommande");
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
				mysqli_query($co,"INSERT INTO ensembleproduits VALUES($numcommande,$numproduit,".$_SESSION['panier']['qteProduit'][$i].")");
			}
			elseif($flag==1){
				mysqli_query($co,"UPDATE ensembleproduits SET quantiteProduit = ".$_SESSION['panier']['qteProduit'][$i]." WHERE numProduit=$numproduit");
				
			}
			else{
				mysqli_query($co,"DELETE FROM ensembleproduits WHERE numProduit=$numproduit");
				
			}
		}
	}
	unset($_SESSION['panier']['nomProduit']);
	unset($_SESSION['panier']['qteProduit']);

	header("Location: ../Vues/html/page_index.php");
?>
