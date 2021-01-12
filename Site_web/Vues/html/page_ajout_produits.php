<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Ajouter un produit</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/ajout_produits.css">
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
	<?php
	$ajout = $_GET["ajout"];
	if($ajout=="oui")
	{
		echo "<h3>Produit ajouté avec succès !</h3>";
	}
	else if($ajout=="non")
	{
		echo "<h3>Échec de l'ajout du produit.</h3>";
	}
	else{}
		?>

	<h1>Ajouter un produit</h1>
	<div class="formulaire_ajout">
		<form action="../../Controleurs/ajout_produit.php" method="POST">
			<p>
				<input type="radio" name="famille" value="Légume" checked="true">
				<label for="famille">Légume</label>
				<input type="radio" name="famille" value="Fruit">
				<label for="famille">Fruit</label>		
			</p>
			<p>
				<label for="nom">Nom du produit :</label>
				<input type="text" name="nom" required="true">
			</p>
			<p>
				<label for="type">Type du produit :</label>
				<input type="text" name="type" required="true">
			</p>
			<p>
				<label for="image">Nom du fichier image du produit :</label>
				<input type="file" name="image" accept="image/*">
			</p>
			<p>
				<label for="quantite">Quantité en stock en kg :</label>
				<input type="number" name="quantite" step="0.1" min="0" required="true">
			</p>
			<p>
				<label for="prix">Prix en €/kg :</label>
				<input type="number" name="prix" step="0.01" min="0" required="true">
			</p>

			<input type="submit" value="Ajouter le produit">
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