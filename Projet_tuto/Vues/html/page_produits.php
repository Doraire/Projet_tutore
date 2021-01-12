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
	<div class="recapitulatif">
		<table>
			<tr>
				<td colspan="3">Contenu de votre panier</td>
			</tr>
			<tr>
				<td>Nom</td>
				<td>Quantité</td>
				<td>Prix</td>
			</tr>
			<?php
			require_once("../../Modeles/bd.php");
			$bd = new Bd();
			$co = $bd->connexion();
			$prix_total = 0;
			if (isset($_SESSION['panier'])){
				$nbArticles=count($_SESSION['panier']['nomProduit']);
				for ($i=0 ;$i < $nbArticles ; $i++){
					if($_SESSION['panier']['qteProduit'][$i]>0)
					{
						$nom_produit = $_SESSION['panier']['nomProduit'][$i];
						$prix_produit = mysqli_query($co, "SELECT prixProduit FROM Produit WHERE nomProduit = '$nom_produit'");
						$prix_produit = mysqli_fetch_assoc($prix_produit);
						$prix_produit = $prix_produit["prixProduit"];
						$prix_produit = $prix_produit*$_SESSION['panier']['qteProduit'][$i];
						$prix_total = $prix_total + $prix_produit;
						echo "<tr>";
						echo "<td>".$nom_produit."</td>";
						echo "<td>".$_SESSION['panier']['qteProduit'][$i]."kg</td>";
						echo "<td>".$prix_produit."€</td>";
						echo "</tr>";
					}					
				}
			}
			if($prix_total>0)
			{
				echo "<tr>
				<td>Total</td>
				<td>Ø</td>
				<td>".$prix_total."€</td>
				</tr>";
			}
			

			?>
		</table>
	</div>
	<div class="liste_produits">
		<?php
		$numcommande = $_GET["numcom"];
		$valeur = 0;
		$reponse = mysqli_query($co, "SELECT nomFamille, typeProduit, nomProduit, prixProduit, quantiteStock, nomImage
			FROM Produit P INNER JOIN Famille F ON (P.numFamille=F.numFamille)
			ORDER BY P.numFamille;");
		$compteur_ligne = 0;
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{
			for ($i=0 ;$i < count($_SESSION['panier']['nomProduit']) ; $i++){
				if($ligne["nomProduit"]==$_SESSION['panier']['nomProduit'][$i]){
					$valeur = $_SESSION['panier']['qteProduit'][$i];
				}
			}
			
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
			<p>".$ligne["typeProduit"]."</p>\n
			<p>".$ligne["prixProduit"]."€/kg</p>\n
			<p>".$ligne["quantiteStock"]."kg</p>\n
			<form action=\"../../Controleurs/ajout_au_panier.php\" method=\"POST\">
			<input class=\"number\" type=\"number\" name=".$ligne["nomProduit"]." value=".$valeur." min=\"0\" max=\"50\" step=\"0.1\">
			<input type=\"text\" name=\"numcommande\" value=\"$numcommande\" style=\"display:none\">
			<input type=\"submit\" value=\"Commander\">
			</form>
			</div>\n";
			$compteur_ligne=$compteur_ligne+1;
			if($compteur_ligne%3==0)
			{
				echo "</div>\n";	
			}
			$valeur = 0;
		}
		?>
	</div>

	<div class="bouton_confirmation">
		<?php
		echo "<form  action=\"../../Controleurs/ajout_commande.php?numcom=$numcommande\" method=\"POST\">	
			<input type=\"submit\" value=\"Confirmer la commande\">";
			?>
		</form>
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
