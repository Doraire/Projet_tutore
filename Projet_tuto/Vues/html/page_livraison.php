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
		<table>
			<tr> 
				<td colspan="7">Liste des livraisons </td>
			</tr>
		<?php
		require_once("../../Modeles/bd.php");
		$bd = new Bd();
		$co = $bd->connexion();
		

		if($_SESSION["estAdmin"])
		{
			echo"<tr>
					<th>Numéro livraison</th>
					<th>Date de livraison</th>
					<th>Numéro de commande</th>
					<th>Numéro client</th>
					<th>Prénom et nom</th>
					<th>Adresse client</th>
					<th>Email </th>
					</tr>";
			$opt = $_GET['optadm'];
			$reponse = mysqli_query($co, "SELECT numLivraison, dateLivraison, numCommande, numClient
					FROM Livraison NATURAL JOIN Commande_Livraison NATURAL JOIN Commande
					ORDER BY numLivraison;");
			if($opt==1){
				$datenow=date('Y-m-d');
				while ($ligne = mysqli_fetch_assoc($reponse)) 
				{
					$datelivraison = $ligne["dateLivraison"];

					$diff=strtotime($datenow) - strtotime($datelivraison);
					if(($diff/86400)<0){
						echo "<tr>
							<td>".$ligne["numLivraison"]."</td>
							<td>".$ligne["dateLivraison"]."</td>
							<td>".$ligne["numCommande"]."</td>";
						$numclient = $ligne["numClient"];
						$resultat2=mysqli_query($co, "SELECT nomClient, prenomClient, mailClient, adresseClient FROM Client WHERE numClient = $numclient");
						while($row2=mysqli_fetch_assoc($resultat2)){
							echo   "<td> $numclient </td>
									<td>".$row2["nomClient"]." ".$row["prenomClient"]."</td>
									<td>".$row2["adresseClient"]."</td>
									<td>".$row2["mailClient"]."</td>";
						}
						echo "<tr>";
					}	
				}
			}
			if($opt==2){		
				while ($ligne = mysqli_fetch_assoc($reponse)) 
				{
					echo "<tr>
							<td>".$ligne["numLivraison"]."</td>
							<td>".$ligne["dateLivraison"]."</td>
							<td>".$ligne["numCommande"]."</td>";
						$numclient = $ligne["numClient"];
						$resultat2=mysqli_query($co, "SELECT nomClient, prenomClient, mailClient, adresseClient FROM Client WHERE numClient = $numclient");
						while($row2=mysqli_fetch_assoc($resultat2)){
							echo   "<td> $numclient </td>
									<td>".$row2["nomClient"]." ".$row["prenomClient"]."</td>
									<td>".$row2["adresseClient"]."</td>
									<td>".$row2["mailClient"]."</td>";
						}
						echo "<tr>";
				}
			}
		}
		else
		{

			echo"<tr>
			<th colspan=\"2\">Numéro livraison</th>
			<th colspan=\"3\">Date de livraison</th>
			<th colspan=\"2\">Numéro de commande</th>
			</tr>";
			$numclient = $_SESSION['num_client'];
			$reponse = mysqli_query($co, "SELECT numLivraison, dateLivraison, numCommande 
				FROM Livraison NATURAL JOIN Commande_Livraison NATURAL JOIN Commande
				WHERE numClient = $numclient
				ORDER BY numLivraison;");
			while ($ligne = mysqli_fetch_assoc($reponse)) 
			{
				echo "<tr>
				<td colspan=\"2\">".$ligne["numLivraison"]."</td>
				<td colspan=\"3\">".$ligne["dateLivraison"]."</td>
				<td colspan=\"2\">".$ligne["numCommande"]."</td>
				</tr>";
			}
		}

		?>
	</table>
	</div>


</body>

</html>
