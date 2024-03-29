<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>
	<title>Connexion</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/connexion.css">
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
	<div class="formulaire">
		<form action="../../Controleurs/connexion.php" method="POST">
			<p>
				<label for="login">Login :</label>
				<input type="text" name="login" placeholder="Entrez votre login" maxlength="20" size="25" required="true">
			</p>
			<p>
				<label for="mdp">Mot de passe :</label>
				<input type="password" name="mdp" placeholder="Entrez votre mot de passe" maxlength="20" size="25" required="true">
			</p>
			<input type="submit" value="Se connecter">
			<a href="page_inscription.php">Vous n'avez pas de compte ?</a>
		</form>
		<?php
		$trompe = $_GET["mdp"];
		if ($trompe == 'nega'){
			echo "Identifiant ou mot de passe incorrecte";
		}
		?>
	</div>
</div>

</body>

</html>