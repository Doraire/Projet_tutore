<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Producteur</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/options_producteur.css">
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
	
	<ul>
		<li><a href="page_ajout_produits.php">Ajouter un produit</li>
		<li><a href="page_commande.php?optadm=1">Consulter les commandes à venir</a></li>
		<li><a href="page_commande.php?optadm=2">Consulter la totalité des commandes</a></li>
		<li><a href="page_livraison.php?optadm=1">Consulter la liste des livraisons à venir</a></li>
		<li><a href="page_livraison.php?optadm=2">Consulter la totalité des livraisons</a></li>
		<li><a href="../../Controleurs/deconnexion.php">Se déconnecter</li>
	</ul>

</body>

</html>
