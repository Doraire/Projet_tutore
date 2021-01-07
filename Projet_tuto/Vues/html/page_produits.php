<!DOCTYPE html>

<html>

<head>
	<title>Liste des produits</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/produits.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
</head>

<body>
	<nav>
		<div class="element_nav"><img src="Images/logo_nav.png" width="75px"></div>
		<div class="element_nav"><a href="">Accueil</a></div>
		<div class="element_nav"><a href="">Produits</a></div>
		<div class="element_nav"><a href="">Nous contacter</a></div>
		<div class="element_nav compte"><a href="">Se connecter</a></div>
	</nav>
	<div class="liste_produits">
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd("localhost", "root", "root", "projet_tutore");
		$co = $bd->connexion();
		$reponse = mysqli_query($co, "SELECT nomFamille, typeProduit, nomProduit, prixProduit, quantiteProduit 
			FROM Produit P INNER JOIN Famille F ON (P.numFamille=F.numFamille)
			ORDER BY P.numFamille;");
		echo "<table>
		<tr>
		<th>Famille</th>
		<th>Nom</th>
		<th>Type</th>
		<th>Prix</th>
		<th>Quantité</th>
		</tr>";
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{
			echo "<tr>
			<td>".$ligne["nomFamille"]."</td>
			<td>".$ligne["nomProduit"]."</td>
			<td>".$ligne["typeProduit"]."</td>
			<td>".$ligne["prixProduit"]."€</td>
			<td>".$ligne["quantiteProduit"]."</td>
			</tr>";
		}
		echo "</table>"
		?>
	</div>
</body>

</html>