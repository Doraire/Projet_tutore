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
	<link rel="stylesheet" type="text/css" href="../css/choix_livraison.css">
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
	<h1>Modalité de livraison</h1>
	<p>Si vous souhaitez être livré avec un voisin, sélectionnez le dans la liste, sinon laissez-la vide. Attention, la livraison reste à l'appréciation du producteur. Grâce à cela vous pourrez potentiellement être livré plus rapidement.</p>
	<div class="formulaire">
		<form action="../../Controleurs/choix_livraison.php" method="POST">
			<p>
				<select name="voisin"  required="true">
					<option value="none">--Choisissez une commande--</option>
					<?php
					require_once("../../Modeles/bd.php");
					$bd = new Bd();
					$co = $bd->connexion();
					$liste_commande = mysqli_query($co, "SELECT Co.numCommande, dateLivraison, adresseClient, nomQuartier FROM Livraison L, Commande_Livraison CL, Commande Co, Client Cli, Quartier Q WHERE L.numLivraison = CL.numLivraison AND CL.numCommande = Co.numCommande AND Co.numClient = Cli.numClient AND Cli.numQuartier = Q.numQuartier AND livree=0");
					while($ligne = mysqli_fetch_assoc($liste_commande))
					{
						echo "<option value=\"".$ligne["numCommande"]."\">".$ligne["dateLivraison"]." - ".$ligne["adresseClient"]." - ".$ligne["nomQuartier"]."</option>";
					}
					?>
				</select>
			</p>
			<input type="submit" value="Choisir ces modalités">
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