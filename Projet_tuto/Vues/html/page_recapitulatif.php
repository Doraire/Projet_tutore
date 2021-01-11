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
	<div class="bouton_panier">
		<form  action="page_produits.php" method="POST">	
			<input type="submit" value="Consulter les produits">
		</form>
	</div>
	<table>
		<tr>
        <td colspan="2">Votre panier</td>
    </tr>
    <tr>
        <td>Nom</td>
        <td>Quantité</td>
    </tr>
	<?php
		if (isset($_SESSION['panier'])){
			$nbArticles=count($_SESSION['panier']['nomProduit']);
			for ($i=0 ;$i < $nbArticles ; $i++){
				echo "<tr>";
				echo "<td>".$_SESSION['panier']['nomProduit'][$i]."</td>";
				echo "<td>".$_SESSION['panier']['qteProduit'][$i]."</td>";
				echo "</tr>";
			}
		}
	?>
	</table>
	<div class="bouton_panier">
		<form  action="../../Controleurs/ajout_commande.php" method="POST">	
			<input type="submit" value="Confirmer la commande">
		</form>
	</div>

</body>

</html>