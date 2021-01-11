<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Choix de la commande</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/faire_commande.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet"> 
</head>

<body>
	<nav>
		<div class="element_nav"><img src="Images/logo_nav.png" width="75px"></div>		
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
	
	<form action="../../Controleurs/faire_commande.php" method="POST">
		<p>
			<input type="radio" name="choix" value="ponctuel" checked="true">
			<label for="choix">Choisir ses ingrédients (ponctuel)</label>
			<br>
			<input type="radio" name="choix" value="hebdo">
			<label for="choix">Le producteur choisit pour moi (hebdomadaire)</label>		
		</p>
		<input type="submit" value="C'est parti !">			
	</form>
</body>

</html>