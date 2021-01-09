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
	<link rel="stylesheet" type="text/css" href="../css/produits.css">
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
	<div class="bouton_panier">
		<form  action="" method="POST">	
			<input type="submit" value="Consulter le panier">
		</form>
	</div>
	<div class="liste_produits">
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		$reponse = mysqli_query($co, "SELECT nomFamille, typeProduit, nomProduit, prixProduit, quantiteStock
			FROM Produit P INNER JOIN Famille F ON (P.numFamille=F.numFamille)
			ORDER BY P.numFamille;");
		$compteur_ligne = 0;
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{
			if($compteur_ligne%3==0)
			{
				echo "<div class=\"ligne_produits\">\n";
			}
			echo "<div class=\"produit\">\n
			<img src=\"Images/image_produits_defaut.png\" alt=\"Image produit\">\n
			<p>".$ligne["nomFamille"]."</p>\n
			<p>".$ligne["nomProduit"]."</p>\n
			<p>".$ligne["prixProduit"]."€/kg</p>\n
			<p>".$ligne["quantiteStock"]."kg</p>\n
			<form action=\"../../Controleurs/modif_client.php\" method=\"POST\">
			<input class=\"number\" type=\"number\" name=\"quantite\" value=\"0\" min=\"0\" max=\"50\" step=\"0.1\">
			<input type=\"submit\" value=\"Commander\">
			</form>
			</div>\n";
			$compteur_ligne=$compteur_ligne+1;
			if($compteur_ligne%3==0)
			{
				echo "</div>\n";	
			}
		}
		?>
	</div>
</body>

</html>