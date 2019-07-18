<?php

require ('model.php');

function listOrders(){
	$commands = getOrders();

	require('orders.php');
}

function createOrders(){
	$driversLoading = getDrivers();
	$driversDelivery = getDrivers();
	$customers = getCustomers();

	if (isset($_POST['send'])){
		if ($_POST['date_chargement'] > $_POST['date_livraison'] OR $_POST['date_chargee'] > $_POST['date_livree'] OR $_POST['heure_chargement'] > $_POST['heure_livraison'] OR $_POST['heure_chargee'] > $_POST['heure_livree']){
		echo 'Impossible de créer !';
		}
		else{
				insertOrders(	$_POST['marque'],
					$_POST['modele'], 
					$_POST['plaque'],
					$_POST['client'], 
					$_POST['adresse_chargement'], 
					$_POST['adresse_livraison'], 
					$_POST['date_chargement'], 
					$_POST['date_livraison'], 
					$_POST['heure_chargement'], 
					$_POST['heure_livraison'], 
					$_POST['date_chargee'], 
					$_POST['date_livree'], 
					$_POST['heure_chargee'], 
					$_POST['heure_livree'], 
					$_POST['chauffeur_chargement'], 
					$_POST['chauffeur_livraison'], 
					$_POST['remarque']
				);
				echo 'La commande pour la '.$_POST['marque'].' '.$_POST['modele'].' a été ajoutée! ';
				?><a href="index.php">Retour</a><?php
		}


	}
	else{
			require('create-orders.php');
	}

	/*if ($_POST['date_chargement'] > $_POST['date_livraison'] OR $_POST['date_chargee'] > $_POST['date_livree'] OR $_POST['heure_chargement'] > $_POST['heure_livraison'] OR $_POST['heure_chargee'] > $_POST['heure_livree']){
		echo 'Impossible de créer !';
	}
	else{
	echo 'La commande pour la '.$_POST['marque'].' '.$_POST['modele'].' a été ajoutée! ';
	?><a href="index.php">Retour</a><?php
	}
else { */


/*}*/


}

function majOrders(){

}

function delOrders(){

}
?>
