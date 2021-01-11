<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Faire une commande</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/commande.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
</head>

<body>
	<nav>
		<div class="element_nav"><img src="Images/logo_nav.png" width="75px"></div>
		<div class="element_nav"><a href="page_index.php">Accueil</a></div>
		<div class="element_nav"><a href="page_produits.php">Produits</a></div>
		<div class="element_nav compte">
			<?php
			if(isset($_SESSION["login"]))
			{
				if($_SESSION["estAdmin"])
				{
					echo "<a href=\"page_options_producteur.php\">Options</a>";
				}
				else
				{
					echo "<a href=\"page_options_client.php\">Mon compte</a>";
				}

			}
			else
			{
				echo "<a href=\"page_connexion.php\">Se connecter</a>";
			}
			?>
		</div>
	</nav>
	<table>
		<tr>
        	<td colspan="8">Liste des commandes</td>
    	</tr>
    	<tr>
    		<td>Num Client</td>
    		<td>Num Commande</td>
    		<td>Date Commande</td>
    		<td>Panier</td>
    		<td>Contenu</td>
    		<td>Date Livraison</td>
	<?php
		include("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		if($_SESSION["estAdmin"])
		{
			$opt = $_GET['optadm'];
			if($opt==1){
				//Côté commande à venir
			echo "<td colspan=\"2\">Determiner la date de livraison</td>
    	</tr>";

    			$resultat=mysqli_query($co, "SELECT numCommande,dateCommande,panierCommande,numClient FROM Commande");
    			while($row=mysqli_fetch_assoc($resultat)){
					$numclient= $row["numClient"];
					$numcommande = $row["numCommande"];
					$datecommande = $row["dateCommande"];
					$panier = $row['panierCommande'];
					echo "<tr>";
					echo "<td> $numclient </td>";
					echo "<td> $numcommande </td>";
					echo "<td> $datecommande </cairo_matrix_transform_distance(matrix, dx, dy)>";
					if(!(empty($panier))){
						//Partie panier
						echo "<td> Oui </td>";
						echo "<td>";
						$resultat2 = mysqli_query($co,"SELECT nomProduit,quantiteProduit FROM compopanier CP, 	Produit P WHERE numPanier = $panier AND CP.numProduit = P.numProduit");
						while($row2 = mysqli_fetch_assoc($resultat2)){
							echo $row2["nomProduit"]." : ".$row2["quantiteProduit"]."kg";
							echo "<br>"; 
						}
						echo "</td>";
					}
					else{
						//Partie ponctuelle
						echo "<td> Non </td>";
						echo "<td>";
						$resultat2 = mysqli_query($co,"SELECT nomProduit,quantiteProduit FROM ensembleproduits 	EP, Produit P WHERE numCommande = $numcommande AND EP.numProduit = P.numProduit");
						while($row2 = mysqli_fetch_assoc($resultat2)){
							echo $row2["nomProduit"]." : ".$row2["quantiteProduit"]."kg";
							echo "<br>"; 
						}
						echo "</td>";
					}
					$resultat3 = mysqli_query($co,"SELECT dateLivraison,livree FROM Livraison L,commande_livraison 	CL WHERE $numcommande = CL.numCommande AND L.numLivraison = CL.numLivraison");	
					$row3 = mysqli_fetch_assoc($resultat3);
					$datelivraison = $row3["dateLivraison"];
					if(!(empty($datelivraison))){
						echo "<td>".$row3["dateLivraison"]."</td>";
						echo "<td> </td>";
					}
					else{
						echo "<td> </td>";
						echo "<td> <form action=\"../../Controleurs/ajout_livraison.php\" method=\"POST\">
										<input type=\"date\" name=\"datelivraison\" min=\"2021-01-01\">	
											<input type=\"submit\" value=\"Choisir\">
									</form></td>";
					}
					echo "<tr>";
				}
			}
			if($opt==2){
				//Côté totalité des commandes
				$resultat=mysqli_query($co, "SELECT numCommande,dateCommande,panierCommande,numClient FROM Commande");
				while($row=mysqli_fetch_assoc($resultat)){
					$numclient= $row["numClient"];
					$numcommande = $row["numCommande"];
					$datecommande = $row["dateCommande"];
					$panier = $row['panierCommande'];
					echo "<tr>";
					echo "<td> $numclient </td>";
					echo "<td> $numcommande </td>";
					echo "<td> $datecommande </td>";	

					if(!(empty($panier))){
						//Partie panier
						echo "<td> Oui </td>";
						echo "<td>";
						$resultat2 = mysqli_query($co,"SELECT nomProduit,quantiteProduit FROM compopanier CP, 	Produit P WHERE numPanier = $panier AND CP.numProduit = P.numProduit");
						while($row2 = mysqli_fetch_assoc($resultat2)){
							echo $row2["nomProduit"]." : ".$row2["quantiteProduit"]."kg";
							echo "<br>"; 
						}
						echo "</td>";
					}
					else{
						//Partie ponctuelle
						echo "<td> Non </td>";
						echo "<td>";
						$resultat2 = mysqli_query($co,"SELECT nomProduit,quantiteProduit FROM ensembleproduits 	EP, Produit P WHERE numCommande = $numcommande AND EP.numProduit = P.numProduit");
						while($row2 = mysqli_fetch_assoc($resultat2)){
							echo $row2["nomProduit"]." : ".$row2["quantiteProduit"]."kg";
							echo "<br>"; 
						}
						echo "</td>";
					}	
					$resultat3 = mysqli_query($co,"SELECT dateLivraison,livree FROM Livraison L,commande_livraison 	CL WHERE $numcommande = CL.numCommande AND L.numLivraison = CL.numLivraison");	
					$row3 = mysqli_fetch_assoc($resultat3);
					echo "<td>".$row3["dateLivraison"]."</td>";
					echo "<tr>";
				}
			}
		}
		else
		{
			echo "<td colspan=\"2\">Modification</td> </tr>";
			//Côté client !
			$numclient=$_SESSION["num_client"];
			$resultat=mysqli_query($co, "SELECT numCommande,dateCommande,panierCommande FROM Commande WHERE numClient = $numclient");
			while($row=mysqli_fetch_assoc($resultat)){
				$numcommande = $row["numCommande"];
				$datecommande = $row["dateCommande"];
				$panier = $row['panierCommande'];
				echo "<tr>";
				echo "<td> $numclient </td>";
				echo "<td> $numcommande </td>";
				echo "<td> $datecommande </td>";	
				if(!(empty($panier))){
					//Partie panier
					echo "<td> Oui </td>";
					echo "<td> Oui </td>";
					echo "<td>";
					$resultat2 = mysqli_query($co,"SELECT nomProduit,quantiteProduit FROM compopanier CP, Produit P WHERE numPanier = $panier AND CP.numProduit = P.numProduit");
					while($row2 = mysqli_fetch_assoc($resultat2)){
						echo $row2["nomProduit"]." : ".$row2["quantiteProduit"]."kg";
						echo "<br>"; 
					}
					echo "</td>";
				}
				else{
					//Partie ponctuelle
					echo "<td> Non </td>";
					echo "<td>";
					$resultat2 = mysqli_query($co,"SELECT nomProduit,quantiteProduit FROM ensembleproduits EP, Produit P WHERE numCommande = $numcommande AND EP.numProduit = P.numProduit");
					while($row2 = mysqli_fetch_assoc($resultat2)){
						echo $row2["nomProduit"]." : ".$row2["quantiteProduit"]."kg";
						echo "<br>"; 
					}
					echo "</td>";
				}
				$resultat3 = mysqli_query($co,"SELECT dateLivraison,livree FROM Livraison L,commande_livraison CL WHERE $numcommande = CL.numCommande AND L.numLivraison = CL.numLivraison");	
				$row3 = mysqli_fetch_assoc($resultat3);
				echo "<td>".$row3["dateLivraison"]."</td>";
				//Faire gaffe a cette partie encore des modifs possibles à faire
				if($row3["livree"]==0){
					//Modification encore possible
					echo "<td>";
					echo "<a href=page_modif_commande.php?numcom=$numcommande>Modifier</a>";
					echo "</td>";
				}
				else{
					//Modification impossible
					echo "<td>Modification impossible </td>";
				}
				echo "<tr>";
			}
		}


	?>
	</table>
</body>

</html>
