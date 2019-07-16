<body>
<?php

require('header.php');
$order = getOrder($_GET['id']);
$getChauffeursChargement = getDrivers();
$getChauffeursLivraison = getDrivers();
$getClients = getCustomers();

if (isset($_POST['send'])){
	updateOrders(	$_GET['id'], 
					$_POST['marque'], 
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
?>La base de données a été modifiée ! <a href="index.php">Retour</a>
<?php }

else { ?>
<form method="post" action="update-orders.php?id=<?php echo $_GET['id'];?>">
	<table>
		<tr><td>Commande</td>
		</tr>
		<tr><td>Numéro de commande</td>
			<td>C<?php echo $order['id_commande']; ?></td>
		</tr>
		<tr><td>Marque</td>
			<td><input type="text" value="<?php echo $order['marque'];?>" name="marque"></td>
		</tr>
		<tr><td>Modèle</td>
			<td><input type="text" value="<?php echo $order['modele'];?>" name="modele"></td>
		</tr>
		<tr><td>Plaque</td>
			<td><input type="text" value="<?php echo $order['plaque'];?>" name="plaque"></td>
		</tr>
		<tr><td>Client</td>
			<td><select name="client">
			<?php while ($client = $getClients->fetch()){
				?><option value="<?php echo $client['id'];?>" <?php if ($order['nom_client'] == $client['nom_client']){
					echo "selected='selected'";}?>><?php echo $client['nom_client'];?></option>
			<?php
			} ?>
				</select></td>
		</tr>
		<tr><td>Adresse de chargement</td>
			<td><input type="text" value="<?php echo $order['adresse_chargement'];?>" name="adresse_chargement"></td>
		</tr>
		<tr><td>Adresse de livraison</td>
			<td><input type="text" value="<?php echo $order['adresse_livraison'];?>" name="adresse_livraison"></td>
		</tr>
		<tr><td>Date de chargement prévue</td>
			<td><input type="date" value="<?php echo $order['date_chargement'];?>" name="date_chargement"></td>
		</tr>
		<tr><td>Heure de chargement prévue</td>
			<td><input type="time" value="<?php echo $order['heure_chargement'];?>" name="heure_chargement"></td>
		</tr>
		<tr><td>Date de livraison prévue</td>
			<td><input type="date" value="<?php echo $order['date_livraison'];?>" name="date_livraison"></td>
		</tr>
		<tr><td>Heure de livraison prévue</td>
			<td><input type="time" value="<?php echo $order['heure_livraison'];?>" name="heure_livraison"></td>
		</tr>
		<tr><td>Date de chargement</td>
			<td><input type="date" value="<?php echo $order['date_chargee'];?>" name="date_chargee"></td>
		</tr>
		<tr><td>Heure de chargement</td>
			<td><input type="time" value="<?php echo $order['heure_chargee'];?>" name="heure_chargee"></td>
		</tr>
		<tr><td>Date de livraison</td>
			<td><input type="date" value="<?php echo $order['date_livree'];?>" name="date_livree"></td>
		</tr>
		<tr><td>Heure de livraison</td>
			<td><input type="time" value="<?php echo $order['heure_livree'];?>" name="heure_livree"></td>
		</tr>
		<tr><td>Chauffeur au chargement</td>
			<td><select name="chauffeur_chargement">
			<?php while ($chauffeurChargement = $getChauffeursChargement->fetch()){
				?><option value="<?php echo $chauffeurChargement['id'];?>" <?php if ($order['chauffeur_chargement'] == $chauffeurChargement['nom_chauffeur']){
					echo "selected='selected'";}?>><?php echo $chauffeurChargement['nom_chauffeur'];?></option>
			<?php
			} ?>
				</select></td>
		</tr>
		<tr><td>Chauffeur à la livraison</td>
			<td><select name="chauffeur_livraison">
			<?php while ($chauffeurLivraison = $getChauffeursLivraison->fetch()){
				?><option value="<?php echo $chauffeurLivraison['id'];?>" <?php if ($order['chauffeur_livraison'] == $chauffeurLivraison['nom_chauffeur']){
					echo "selected='selected'";}?>><?php echo $chauffeurLivraison['nom_chauffeur'];?></option>
			<?php
			} ?>
				</select></td>
		</tr>
		<tr><td>Remarque</td>
			<td><input type="textarea" value="<?php echo $order['remarque'];?>" name="remarque"></td>
		</tr>
		<tr><td></td>
			<td><input type="submit" name="send" value="Modifier"></td>
		</tr>
	</table>
</form>

<a href="index.php">Retour à la liste des commandes</a>

<?php } ?>
</body>
</html>