<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Faire son panier</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/panier.css">
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
	<h1>Je paramètre mon panier</h1>
	<div class="formulaire">
		<form action="../../Controleurs/panier.php" method="POST">
			<p>
				<label for="nb_personnes">Quel est le prix maximal du panier ?</label>
				<input type="number" step="0.01" name="prix_limite" min="0" max="150" required="true">
			</p>
			<p>
				<select name="jour"  required="true">
					<option value="">--Choisissez un jour de livraison--</option>
					<option value="Lundi">Lundi</option>
					<option value="Mardi">Mardi</option>
					<option value="Mercredi">Mercredi</option>
					<option value="Jeudi">Jeudi</option>
					<option value="Vendredi">Vendredi</option>
					<option value="Samedi">Samedi</option>
					<option value="Dimanche">Dimanche</option>
				</select>
			</p>
			<p>
				<label for="nb_personnes">Le panier est pour combien de personnes ?</label>
				<input type="number" step="1" name="nb_personnes" min="0" max="10" required="true">
			</p>
			<input type="submit" value="Je commande un panier de ce type">
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
