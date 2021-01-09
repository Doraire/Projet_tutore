<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Liste des produits</title>
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
	<div class="commande_ponctuelle">
		<h2>Commandes ponctuelles</h2>
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		$reponse = mysqli_query($co, "SELECT dateCommande, EP.numCommande, nomProduit, EP.quantiteProduit
			FROM Commande C, EnsembleProduits EP, Produit Pr
			WHERE EP.numCommande = C.numCommande
			AND EP.numProduit = Pr.numProduit
			ORDER BY EP.numCommande;");
		echo "<table>
		<tr>
		<th>Date de commande</th>
		<th>Numéro de commande</th>
		<th>Nom du produit</th>
		<th>Quantité</th>
		</tr>";
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{
			echo "<tr>
			<td>".$ligne["dateCommande"]."</td>
			<td>".$ligne["numCommande"]."</td>
			<td>".$ligne["nomProduit"]."</td>
			<td>".$ligne["quantiteProduit"]."</td>
			</tr>";
		}
		echo "</table>"
		?>
	</div>

	<div class="commande_hebdomadaire">
		<h2>Commandes hebdomadaires</h2>
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		$reponse = mysqli_query($co, "SELECT dateCommande, numCommande, nomProduit, CP.quantiteProduit
			FROM Commande C, Panier Pa, CompoPanier CP, Produit Pr
			WHERE C.panierCommande = Pa.numPanier
			AND Pa.numPanier = CP.numPanier
			AND CP.numProduit = Pr.numProduit
			ORDER BY numCommande;");
		echo "<table>
		<tr>
		<th>Date de commande</th>
		<th>Numéro de commande</th>
		<th>Nom du produit</th>
		<th>Quantité</th>
		</tr>";
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{
			echo "<tr>
			<td>".$ligne["dateCommande"]."</td>
			<td>".$ligne["numCommande"]."</td>
			<td>".$ligne["nomProduit"]."</td>
			<td>".$ligne["quantiteProduit"]."</td>
			</tr>";
		}
		echo "</table>"
		?>
	</div>
</body>

</html>