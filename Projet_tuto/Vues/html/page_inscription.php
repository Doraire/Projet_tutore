<!DOCTYPE html>

<html>

<head>
	<title>Inscription</title>
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
		<div class="element_nav"><a href="">Accueil</a></div>
		<div class="element_nav"><a href="">Produits</a></div>
		<div class="element_nav"><a href="">Nous contacter</a></div>
		<div class="element_nav compte"><a href="">Se connecter</a></div>
	</nav>

	<div class="formulaire">
		<form action="../../Controleurs/inscription.php" method="POST">
			<p>
				<label for="nom">Nom :</label>
				<input type="text" name="nom" placeholder="Entrez votre nom" maxlength="20" size="25">
			</p>
			<p>
				<label for="prenom">Prénom :</label>
				<input type="text" name="prenom" placeholder="Entrez votre prénom" maxlength="20" size="25">
			</p>
			<p>
				<label for="mail">Mail :</label>
				<input type="email" name="mail" placeholder="Entrez votre e-m@il" maxlength="20" size="25">
			</p>
			<p>
				<label for="adresse">Adresse :</label>
				<input type="text" name="adresse" placeholder="Entrez votre adresse" maxlength="20" size="25">
			</p>
			<p>
				<label for="quartier">Quartier :</label>
				<input type="text" name="quartier" placeholder="Entrez votre quartier" maxlength="20" size="25">
			</p>
			<p>
				<label for="login">Login :</label>
				<input type="text" name="login" placeholder="Entrez votre login" maxlength="20" size="25">
			</p>
			<p>
				<label for="mdp">Mot de passe :</label>
				<input type="password" name="mdp" placeholder="Entrez votre mot de passe" maxlength="20" size="25">
			</p>
			<input type="submit" value="S'inscrire">
			<a href="page_connexion.php">Vous avez déjà un compte ?</a>
		</form>
	</div>

</body>

</html>