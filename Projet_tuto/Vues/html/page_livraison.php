<?php
session_start();
?>

<!DOCTYPE html>

<html>

<head>

	<title>Se faire livrer</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/livraison.css">
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
	<div class="liste_livraisons">
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		$reponse = mysqli_query($co, "SELECT numLivraison, dateLivraison, numCommande 
			FROM Livraison NATURAL JOIN Commande_Livraison NATURAL JOIN Commande
			ORDER BY numLivraison;");
		echo "<table>
		<tr>
		<th>Numéro livraison</th>
		<th>Date de livraison</th>
		<th>Numéro de commande</th>
		</tr>";
		while ($ligne = mysqli_fetch_assoc($reponse)) 
		{
			echo "<tr>
			<td>".$ligne["numLivraison"]."</td>
			<td>".$ligne["dateLivraison"]."</td>
			<td>".$ligne["numCommande"]."</td>
			</tr>";
		}
		echo "</table>"
		?>
	</div>


</body>

</html>