<body>
<?php 
require('header.php');
$driversLoading = getDrivers();
$driversDelivery = getDrivers();
$customers = getCustomers();

if (isset($_POST['send'])){
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
	if ($_POST['date_chargement'] > $_POST['date_livraison'] OR $_POST['date_chargee'] > $_POST['date_livree'] OR $_POST['heure_chargement'] > $_POST['heure_livraison'] OR $_POST['heure_chargee'] > $_POST['heure_livree']){
		echo 'Impossible de créer !';
	}
	else{
	echo 'La commande pour la '.$_POST['marque'].' '.$_POST['modele'].' a été ajoutée! ';
	?><a href="index.php">Retour</a><?php
	}
}
else { ?>
<form method="post" action="create-orders.php">
	<table>
		<tr><td>Commande</td></tr>
		<tr><td>Marque</td>
			<td><input type="text" value="" name="marque">
			</td>
		</tr>
		<tr><td>Modèle</td>
			<td><input type="text" value="" name="modele">
			</td>
		</tr>
		<tr><td>Plaque</td>
			<td><input type="text" value="" name="plaque">
			</td>
		</tr>
		<tr><td>Client</td>
			<td><select name="client">
				<option value=NULL>- -</option>
				<?php while ($client = $customers->fetch()){
					?><option value="<?php echo $client['id'];?>"><?php echo $client['nom_client'];?></option>
				<?php } ?>
				</select>
			</td>
		</tr>
		<tr><td>Adresse de chargement</td>
			<td><input type="text" value="" name="adresse_chargement">
			</td>
		</tr>
		<tr><td>Adresse de livraison</td>
			<td><input type="text" value="" name="adresse_livraison">
			</td>
		</tr>
		<tr><td>Date de chargement prévue</td>
			<td><input type="date" value="" name="date_chargement">
			</td>
		</tr>
		<tr><td>Heure de chargement prévue</td>
			<td><input type="time" value="" name="heure_chargement">
			</td>
		</tr>
		<tr><td>Date de livraison prévue</td>
			<td><input type="date" value="" name="date_livraison">
			</td>
		</tr>
		<tr><td>Heure de livraison prévue</td>
			<td><input type="time" value="" name="heure_livraison">
			</td>
		</tr>
		<tr><td>Date de chargement</td>
			<td><input type="date" value="" name="date_chargee">
			</td>
		</tr>
		<tr><td>Heure de chargement</td>
			<td><input type="time" value="" name="heure_chargee">
			</td>
		</tr>
		<tr><td>Date de livraison</td>
			<td><input type="date" value="" name="date_livree">
			</td>
		</tr>
		<tr><td>Heure de livraison</td>
			<td><input type="time" value="" name="heure_livree">
			</td>
		</tr>
		<tr><td>Chauffeur au chargement</td>
			<td><select name="chauffeur_chargement">
				<option value=NULL>- -</option>
			<?php while ($chauffeurChargement = $driversLoading->fetch()){
				?><option value="<?php echo $chauffeurChargement['id'];?>"><?php echo $chauffeurChargement['nom_chauffeur'];?></option>
			<?php } ?>
				</select>
			</td>
		</tr>
		<tr><td>Chauffeur à la livraison</td>
			<td><select name="chauffeur_livraison">
				<option value=NULL>- -</option>
			<?php while ($chauffeurLivraison = $driversDelivery->fetch()){
				?><option value="<?php echo $chauffeurLivraison['id'];?>"><?php echo $chauffeurLivraison['nom_chauffeur'];?></option>
			<?php } ?>
				</select>
			</td>
		</tr>
		<tr><td>Remarque</td>
			<td><input type="textarea" value="" name="remarque">
			</td>
		</tr>
		<tr><td><a href="index.php">Annuler</a></td>
			<td><input type="submit" value="Ajouter" name="send">
			</td>
		</tr>

	</table>
</form>
<?php } ?>






</body>
</html>