<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Gérer les stocks</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/stocks.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
</head>

<body>
	<nav>
		<div class="element_nav"><img src="Images/logo_nav.png" width="75px"></div>
		<div class="element_nav"><a href="page_accueil.php">Accueil</a></div>		
		<div class="element_nav"><a href="page_produits.php">Produits</a></div>
		<div class="element_nav"><a href="page_faire_commande.php">Faire une commande</a></div>
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
	<h1>Gestion des stocks</h1>

	<div class="liste_produits">
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		$reponse = mysqli_query($co, "SELECT nomFamille, typeProduit, nomProduit, prixProduit, quantiteStock, nomImage
			FROM Produit P INNER JOIN Famille F ON (P.numFamille=F.numFamille)
			ORDER BY P.numFamille;");
		$compteur_ligne = 0;
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{		
			if($compteur_ligne%3==0)
			{
				echo "<div class=\"ligne_produits\">\n";
			}
			echo "<div class=\"produit";
			if($ligne["quantiteStock"]==0)
			{
				echo " rupture\">\n";
			}
			else
			{
				echo "\">\n";
			}
			if($ligne["nomImage"])
			{
				echo "<img src=\"Images/".$ligne["nomImage"]."\" alt=\"Image produit\">\n";
			}
			else
			{
				echo "<img src=\"Images/image_produits_defaut.png\" alt=\"Image produit\">\n";
			}
			

			echo "<p>".$ligne["nomFamille"]."</p>\n
			<p>".$ligne["nomProduit"]."</p>\n
			<p>Type : ".$ligne["typeProduit"]."</p>\n
			<p>".$ligne["prixProduit"]."€/kg</p>\n
			<p>En stock : ".$ligne["quantiteStock"]."kg</p>\n
			<form action=\"../../Controleurs/stocks.php\" method=\"POST\">
			<input class=\"number\" type=\"number\" name=".$ligne["nomProduit"]." min=\"0\" step=\"0.01\" required=\"true\">
			<input type=\"submit\" value=\"Changer le prix (€/kg)\" name=\"prix\">
			</form>
			<form action=\"../../Controleurs/stocks.php\" method=\"POST\">
			<input class=\"number\" type=\"number\" name=".$ligne["nomProduit"]." min=\"0\" step=\"0.1\" required=\"true\">
			<input type=\"submit\" value=\"Changer la quantité (kg)\" name=\"quantite\">
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



	<?php
	if($_SESSION["num_client"])
	{
		echo "<footer>
		<form action=\"../../Controleurs/deconnexion.php\" method=\"POST\">
		<input type=\"submit\" value=\"Déconnexion\">
		</form>
		</footer>";
	}
	
	?>
</body>

</html>
