<?php

/* regex tracteur #1[A-Z][A-Z][A-Z][0-9][0-9][0-9]#
regex remorque #Q[A-Z][A-Z][A-Z][0-9][0-9][0-9]# 
*/
require('controller.php');

function dbConnect(){
	try{
		$db = new PDO('mysql:host=localhost;dbname=transport;charset=utf8','quentin','aqzsed');
		return $db;
	}
	catch (Exception $e){
		die('Erreur : '.$e->getMessage());
	}
}

function getCustomers(){
	$db = dbConnect();
	$customers = $db->query('SELECT * FROM client ORDER BY id');
	
	return $customers;

}

function getCustomer($customerId){
	$db = dbConnect();
	$sqlreq = $db->prepare('SELECT * FROM client WHERE id= ?');
	$sqlreq->execute(array($customerId));
	$customer = $sqlreq->fetch();

	return $customer;
}

function insertCustomers($nom, $adresse, $telephone, $email){
	$db = dbConnect();
	$insertCustomer = $db->prepare('INSERT INTO client(nom_client, adresse, telephone, email) VALUES (:nom, :adresse, :telephone, :email)');
	$insertCustomer->execute(array(
		'nom' => $nom,
		'adresse' => $adresse,
		'telephone' => $telephone,
		'email' => $email
	));
}

function updateCustomers($customerId, $nom, $adresse, $telephone, $email){
	$db = dbConnect();
	$customer_update = $db->prepare('UPDATE client SET nom_client = :nom, adresse = :adresse, telephone = :telephone, email = :email WHERE id = :id');
	$customer_update->execute(array(
		'id' => $customerId,
		'nom' => $nom,
		'adresse' => $adresse,
		'telephone' => $telephone,
		'email' => $email
	));

	return $customer_update;
}

function deleteCustomers($customerId){
	$db = dbConnect();
	$sqlreq = $db->prepare('DELETE FROM client WHERE id=?');
	$sqlreq->execute(array($customerId));
}

function getOrders(){
	$db = dbConnect();
	$commands = $db->query('SELECT *, co.id as id_commande, cha.nom_chauffeur as chauffeur_chargement, cfr.nom_chauffeur as chauffeur_livraison, DATE_FORMAT(date_chargement,"%d/%m/%y") as date_chargement, DATE_FORMAT(date_livraison,"%d/%m/%y") as date_livraison, DATE_FORMAT(date_chargee,"%d/%m/%y") as date_chargee, DATE_FORMAT(date_livree,"%d/%m/%y") as date_livree, DATE_FORMAT(heure_chargement,"%H:%i") as heure_chargement, DATE_FORMAT(heure_livraison,"%H:%i") as heure_livraison, DATE_FORMAT(heure_chargee,"%H:%i") as heure_chargee, DATE_FORMAT(heure_livree,"%H:%i") as heure_livree
		FROM commande as co
		JOIN client as cli ON cli.id = co.client 
		LEFT JOIN chauffeur cha ON co.chauffeur_chargement = cha.id
		LEFT JOIN chauffeur cfr ON co.chauffeur_livraison = cfr.id');

	return $commands;
}

function getOrder($orderId){
	$db = dbConnect();
	$sqlreq = $db->prepare('SELECT *, co.id as id_commande, cha.nom_chauffeur as chauffeur_chargement, cfr.nom_chauffeur as chauffeur_livraison, date_chargement, date_livraison, date_chargee, date_livree, DATE_FORMAT(heure_chargement,"%H:%i") as heure_chargement, DATE_FORMAT(heure_livraison,"%H:%i") as heure_livraison, DATE_FORMAT(heure_chargee,"%H:%i") as heure_chargee, DATE_FORMAT(heure_livree,"%H:%i") as heure_livree	
		FROM commande as co
		JOIN client as cli ON cli.id = co.client 
		LEFT JOIN chauffeur cha ON co.chauffeur_chargement = cha.id
		LEFT JOIN chauffeur cfr ON co.chauffeur_livraison = cfr.id WHERE co.id = ?');
		$sqlreq->execute(array($orderId));
	$order = $sqlreq->fetch();

	return $order;
}

function insertOrders(	$marque, 
						$modele, 
						$plaque, 
						$client, 
						$adresse_chargement, 
						$adresse_livraison, 
						$date_chargement, 
						$date_livraison, 
						$heure_chargement, 
						$heure_livraison, 
						$date_chargee, 
						$date_livree, 
						$heure_chargee, 
						$heure_livree, 
						$chauffeur_chargement, 
						$chauffeur_livraison, 
						$remarque
					){
	$db = dbConnect();
	$insertOrder = $db->prepare('INSERT INTO commande( 
						marque, 
						modele, 
						plaque, 
						client, 
						adresse_chargement, 
						adresse_livraison, 
						date_chargement, 
						date_livraison, 
						heure_chargement, 
						heure_livraison, 
						date_chargee, 
						date_livree, 
						heure_chargee, 
						heure_livree, 
						chauffeur_chargement, 
						chauffeur_livraison, 
						remarque) VALUES ( 
						:marque, 
						:modele, 
						:plaque, 
						:client, 
						:adresse_chargement, 
						:adresse_livraison, 
						:date_chargement, 
						:date_livraison, 
						:heure_chargement, 
						:heure_livraison, 
						:date_chargee, 
						:date_livree, 
						:heure_chargee, 
						:heure_livree, 
						:chauffeur_chargement, 
						:chauffeur_livraison, 
						:remarque)');
	$insertOrder->execute(array(
		'marque' => $marque,
		'modele' => $modele,
		'plaque' => $plaque,
		'client' => $client,
		'adresse_chargement' => $adresse_chargement,
		'adresse_livraison' => $adresse_livraison,
		'date_chargement' => $date_chargement,
		'date_livraison' => $date_livraison,
		'heure_chargement' => $heure_chargement,
		'heure_livraison' => $heure_livraison,
		'date_chargee' => $date_chargee,
		'date_livree' => $date_livree,
		'heure_chargee' => $heure_chargee,
		'heure_livree' => $heure_livree,
		'chauffeur_chargement' => $chauffeur_chargement,
		'chauffeur_livraison' => $chauffeur_livraison,
		'remarque' => $remarque
	));
}

function updateOrders(	$orderId, 
						$marque, 
						$modele, 
						$plaque, 
						$client, 
						$adresse_chargement, 
						$adresse_livraison, 
						$date_chargement, 
						$date_livraison, 
						$heure_chargement, 
						$heure_livraison, 
						$date_chargee, 
						$date_livree, 
						$heure_chargee, 
						$heure_livree, 
						$chauffeur_chargement, 
						$chauffeur_livraison, 
						$remarque
					){
	$db = dbConnect();
	$order_update = $db->prepare('UPDATE commande SET 
		marque = :marque, 
		modele = :modele, 
		plaque = :plaque, 
		client = :client, 
		adresse_chargement = :adresse_chargement, 
		adresse_livraison = :adresse_livraison, 
		date_chargement = :date_chargement, 
		date_livraison = :date_livraison, 
		heure_chargement = :heure_chargement, 
		heure_livraison = :heure_livraison, 
		date_chargee = :date_chargee, 
		date_livree = :date_livree, 
		heure_chargee = :heure_chargee, 
		heure_livree = :heure_livree, 
		chauffeur_chargement = :chauffeur_chargement, 
		chauffeur_livraison = :chauffeur_livraison, 
		remarque = :remarque WHERE id = :id');
	$order_update->execute(array(
		'id' => $orderId,
		'marque' => $marque,
		'modele' => $modele,
		'plaque' => $plaque,
		'client' => $client,
		'adresse_chargement' => $adresse_chargement,
		'adresse_livraison' => $adresse_livraison,
		'date_chargement' => $date_chargement,
		'date_livraison' => $date_livraison,
		'heure_chargement' => $heure_chargement,
		'heure_livraison' => $heure_livraison,
		'date_chargee' => $date_chargee,
		'date_livree' => $date_livree,
		'heure_chargee' => $heure_chargee,
		'heure_livree' => $heure_livree,
		'chauffeur_chargement' => $chauffeur_chargement,
		'chauffeur_livraison' => $chauffeur_livraison,
		'remarque' => $remarque
	));

	return $order_update;
}

function deleteOrders($orderId){
	$db = dbConnect();
	$sqlreq = $db->prepare('DELETE FROM commande WHERE id=?');
	$sqlreq->execute(array($orderId));	
}

function getDrivers(){
	$db = dbConnect();
	$drivers = $db->query('SELECT *, cha.id as id_chauffeur, tr.plaque as plaque_tracteur, re.plaque as plaque_remorque
						FROM chauffeur as cha 
						JOIN tracteur tr ON tr.id = cha.tracteur
						JOIN remorque re ON re.id = cha.remorque');

	return $drivers;
}

function getDriver($driverId){
	$db = dbConnect();
	$sqlreq = $db->prepare('SELECT *, cha.id as id_chauffeur, tr.plaque as plaque_tracteur, re.plaque as plaque_remorque
						FROM chauffeur as cha
						JOIN tracteur tr ON tr.id = cha.tracteur
						JOIN remorque re ON re.id = cha.remorque WHERE cha.id = ?');
	$sqlreq->execute(array($driverId));
	$driver = $sqlreq->fetch();

	return $driver;
}

function updateDrivers($driverId, $nom, $prenom, $ville, $tracteur, $remorque){
	$db = dbConnect();
	$driver_update = $db->prepare('UPDATE chauffeur SET nom_chauffeur = :nom, prenom_chauffeur = :prenom, ville = :ville, tracteur = :tracteur, remorque = :remorque WHERE id = :id');
	$driver_update->execute(array(
		'id' => $driverId,
		'nom' => $nom,
		'prenom' => $prenom,
		'ville' => $ville,
		'tracteur' => $tracteur,
		'remorque' => $remorque
	));

	return $driver_update;
}

function insertDrivers($nom, $prenom, $ville, $tracteur, $remorque){
	$db = dbConnect();
	$insertDriver = $db->prepare('INSERT INTO chauffeur(nom_chauffeur, prenom_chauffeur, ville, tracteur, remorque) VALUES (:nom, :prenom, :ville, :tracteur, :remorque)'); 
	$insertDriver->execute(array(
		'nom' => $nom,
		'prenom' => $prenom,
		'ville' => $ville,
		'tracteur' => $tracteur,
		'remorque' => $remorque
	));	
}

function deleteDrivers($driverId){
	$db = dbConnect();
	$sqlreq = $db->prepare('DELETE FROM chauffeur WHERE id=?');
	$sqlreq->execute(array($driverId));
}

function getTrucks(){
	$db = dbConnect();
	$trucks = $db->query('SELECT * FROM tracteur as tr');
/*les tables camion et remorque ne listent pas les entrées chauffeur auxquelles elles sont attribuées... 
ajouter les relations au chauffeur , et aussi à la remorque associée et inversément*/
	return $trucks;
}

function getTrucksByOrder($orderBy){
	$db = dbConnect();
	$trucks = $db->prepare('CALL tri(?)');
	$trucks->execute(array($orderBy));

	return $trucks;
}
//query('SELECT * FROM tracteur ORDER BY '.$orderBy.'') FONCTIONNE 

function getTruck($truckId){
	$db = dbConnect();
	$sqlreq = $db->prepare('SELECT * FROM tracteur WHERE id=?');
	$sqlreq->execute(array($truckId));
	$truck = $sqlreq->fetch();

	return $truck;
}

function updateTrucks($truckId, $marque, $modele, $plaque, $annee){
	$db = dbConnect();
	$truck_update = $db->prepare('UPDATE tracteur SET marque = :marque, modele = :modele, plaque = :plaque, annee = :annee WHERE id = :id ');
	$truck_update->execute(array(
		'id' => $truckId,
		'marque' => $marque,
		'modele' => $modele,
		'plaque' => $plaque,
		'annee' => $annee
	));

	return $truck_update;
}

function insertTrucks($marque, $modele, $plaque, $annee){
	$db = dbConnect();
	$insertTruck = $db->prepare('INSERT INTO tracteur(marque, modele, plaque, annee) VALUES (:marque, :modele, :plaque, :annee)');
	$insertTruck->execute(array(
		'marque' => $marque,
		'modele' => $modele,
		'plaque' => $plaque,
		'annee' => $annee
	));	
}

function deleteTrucks($truckId){
	$db = dbConnect();
	$sqlreq = $db->prepare('DELETE FROM tracteur WHERE id=?');
	$sqlreq->execute(array($truckId));
}

function getTrailers(){
	$db = dbConnect();
	$trailers = $db->query('SELECT * FROM remorque as re');

	return $trailers;
}

function getTrailer($trailerId){
	$db = dbConnect();
	$sqlreq = $db->prepare('SELECT * FROM remorque WHERE id=?');
	$sqlreq->execute(array($trailerId));
	$trailer = $sqlreq->fetch();

	return $trailer;
}

function updateTrailers($trailerId, $marque, $modele, $plaque, $annee){
	$db = dbConnect();
	$trailer_update = $db->prepare('UPDATE remorque SET marque = :marque, modele = :modele, plaque = :plaque, annee = :annee WHERE id = :id');
	$trailer_update->execute(array(
		'id' => $trailerId,
		'marque' => $marque,
		'modele' => $modele,
		'plaque' => $plaque,
		'annee' => $annee
	));

	return $trailer_update;
}

function insertTrailers($marque, $modele, $plaque, $annee){
	$db = dbConnect();
	$insertTrailer = $db->prepare('INSERT INTO remorque(marque, modele, plaque, annee) VALUES (:marque, :modele, :plaque, :annee)');
	$insertTrailer->execute(array(
		'marque' => $marque,
		'modele' => $modele,
		'plaque' => $plaque,
		'annee' => $annee
	));
}

function deleteTrailers($trailerId){
	$db = dbConnect();
	$sqlreq = $db->prepare('DELETE FROM remorque WHERE id=?');
	$sqlreq->execute(array($trailerId));
}


?>