<?php
	session_start();

	if (!isset($_SESSION['panier'])){
      $_SESSION['panier']=array();
      $_SESSION['panier']['nomProduit'] = array();
      $_SESSION['panier']['qteProduit'] = array();
    }
    $numcommande = $_POST["numcommande"];
    foreach( $_POST as $cle=>$value)
	{
		if($cle!="numcommande"){		
	        	$flag = 0;

			//Code pour remplacer la quantité si on trouve le même produit
		
			for ($i=0 ;$i < count($_SESSION['panier']['nomProduit']); $i++){
				if($cle == $_SESSION['panier']['nomProduit'][$i]){
					$_SESSION['panier']['qteProduit'][$i] = $value;
					$flag = 1;
				}
			}


			//Ajout des produits dans le panier
			if($flag==0){
				array_push($_SESSION['panier']['nomProduit'],$cle);
        		array_push($_SESSION['panier']['qteProduit'],$value);
			}
		}
  	}
	
	header("Location: ../Vues/html/page_produits.php?numcom=$numcommande");
?>
