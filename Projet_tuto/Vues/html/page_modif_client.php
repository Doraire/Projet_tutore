<?php
session_start();
?>
<!DOCTYPE html>

<html>

<head>
	<title>Modifier une commande</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/modif_client.css">
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
	<h2>Entrez uniquement les données que vous voulez changer :</h2>
	<div class="formulaire">
		<div class="information">
			<?php
			require_once("../../Modeles/bd.php");
			$bd = new Bd();
			$co = $bd->connexion();
			$num_client = $_SESSION["num_client"];
			$reponse = mysqli_query($co, "SELECT nomClient, prenomClient, mailClient, loginClient, adresseClient, nomQuartier FROM Client NATURAL JOIN Quartier WHERE numClient = '$num_client'");
			$reponse = mysqli_fetch_assoc($reponse);
			echo "<p>Votre nom : ".$reponse["nomClient"]."</p>\n";
			echo "<p>Votre prénom : ".$reponse["prenomClient"]."</p>\n";
			echo "<p>Votre mail : ".$reponse["mailClient"]."</p>\n";
			echo "<p>Votre login : ".$reponse["loginClient"]."</p>\n";
			echo "<p>Votre adresse : ".$reponse["adresseClient"]."</p>\n";
			echo "<p>Votre quartier : ".$reponse["nomQuartier"]."</p>\n";
			?>
		</div>
		<div class="changement">
			<form action="../../Controleurs/modif_client.php" method="POST">
				<p>
					<label for="nom">Nom :</label>
					<input type="text" name="nom" placeholder="Changez votre nom" maxlength="20" size="25">
				</p>
				<p>
					<label for="prenom">Prénom :</label>
					<input type="text" name="prenom" placeholder="Changez votre prénom" maxlength="20" size="25">
				</p>
				<p>
					<label for="login">Login :</label>
					<input type="text" name="login" placeholder="Changez votre login" maxlength="20" size="25">
				</p>
				<p>
					<label for="mail">Mail :</label>
					<input type="email" name="mail" placeholder="Changez votre e-m@il" maxlength="20" size="25">
				</p>
				<p>
					<label for="adresse">Adresse :</label>
					<input type="text" name="adresse" placeholder="Changez votre adresse" maxlength="20" size="25">
				</p>
				<p>
					<label for="quartier">Quartier :</label>
					<input type="text" name="quartier" placeholder="Changez votre quartier" maxlength="20" size="25">
				</p>
				<p>
					<label for="mdp">Mot de passe :</label>
					<input type="password" name="mdp" placeholder="Changez votre mot de passe" maxlength="20" size="25">
				</p>
				<input type="submit" value="Changez les données">
			</form>
		</div>
	</div>
</nav>
</body>

</html>